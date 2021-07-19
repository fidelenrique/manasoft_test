<?php

namespace App\Service\Equipment;

use App\Entity\Equipment;
use App\Service\InfoCodes;
use Doctrine\DBAL\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Validator\EquipmentValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;

class EquipmentProvider implements EquipmentProviderInterface
{
    protected EntityManagerInterface $em;
    protected EquipmentValidatorInterface $validatorEqt;

    /**
     * EquipmentController constructor.
     * @param EntityManagerInterface $em
     * @param EquipmentValidatorInterface $vEqt
     */
    public function __construct(EntityManagerInterface $em, EquipmentValidatorInterface $vEqt)
    {
        $this->em = $em;
        $this->validatorEqt = $vEqt;
    }

    /**
     * Set and Get query params for Requests list
     * @param array $queryParams
     * @return array
     * @throws Exception
     */
    public function getQueryParams(array $queryParams): array
    {
        $params = [];

        /* 1. Get index */
        if (!empty($queryParams['offset'])) $params['offset'] = (int) $queryParams['offset'];

        /* 2. Get max */
        if (isset($queryParams['max']) && !is_null($queryParams['max'])) $params['max'] = (int) $queryParams['max'];

        /* 3. Get sort */
        if (!empty($queryParams['sort'])) {
            if (!in_array($queryParams['sort'], array_keys(Equipment::SORTS))) {
                throw new Exception(InfoCodes::EQUIPMENT_WRONG_SORTS, Response::HTTP_BAD_REQUEST);
            }
            $params['sort'] = Equipment::SORTS[$queryParams['sort']];
        }

        /* 4. Get order (ASC or DESC) */
        if (isset($queryParams['order']) && !is_null($queryParams['order'])) $params['order'] = ((int) $queryParams['order'] === 1 ? 'ASC' : 'DESC');

        return $params;
    }

    public function createEquipment($request)
    {
        $content = (array)json_decode($request->getContent());
        $this->validatorEqt->validateParams($content);
        $equipment = new Equipment();
        $equipment->setCategory($content['category']);
        $equipment->setName($content["name"]);
        $equipment->setNumber($content["number"]);
        $this->em->persist($equipment);
        $this->em->flush();

        return [
            "id" => $equipment->getId(),
            "name" => $equipment->getName(),
            "category" => $equipment->getCategory(),
            "number" => $equipment->getNumber(),
            "createdAt" => $equipment->getCreatedAt()
        ];
    }

    /**
     * @param Equipment $equipment
     * @return array
     */
    public function getEquipment(Equipment $equipment): array
    {
        $object = $this->em->getRepository(Equipment::class)->findOneBy(['id' => $equipment]);
        return [
            "name" => $object->getName(),
            "category" => $object->getCategory(),
            "number" => $object->getNumber(),
            "createdAt" => $object->getCreatedAt(),
            "updatedAt" => $object->getUpdatedAt()
        ];
    }

    /**
     * @param Equipment $equipment
     */
    public function deleteEquipment(Equipment $equipment)
    {
        $this->em->remove($equipment);
        $this->em->flush();
    }

    /**
     * @param Equipment $equipment
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function updateEquipment(Equipment $equipment, Request $request)
    {
        $content = (array)json_decode($request->getContent());

        if (isset($content["name"])) {
            $equipment->setName($content["name"]);
        }

        if (isset($content["category"])) {
            $equipment->setCategory($content["category"]);
        }

        if (isset($content['number'])) {
            if (!is_numeric($content['number'])) {
                throw new Exception(InfoCodes::EQUIPMENT_NOT_NUMERIC, Response::HTTP_BAD_REQUEST);
            }
            $equipment->setNumber($content["number"]);
        }

        $this->em->persist($equipment);
        $this->em->flush();

        return [
            "name" => $equipment->getName(),
            "category" => $equipment->getCategory(),
            "number" => $equipment->getNumber(),
            "createdAt" => $equipment->getCreatedAt(),
            "updatedAt" => $equipment->getUpdatedAt()
        ];
    }
}
