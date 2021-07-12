<?php

namespace App\Controller;

use App\Repository\EquipmentRepository;
use App\Service\Equipment\EquipmentProviderInterface;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Equipment;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class EquipmentController extends CommonController
{
    protected EntityManagerInterface $em;
    protected EquipmentProviderInterface $equipmentProvider;

    /**
     * EquipmentController constructor.
     * @param EntityManagerInterface $em
     * @param EquipmentProviderInterface $eqt
     */
    public function __construct(EntityManagerInterface $em, EquipmentProviderInterface $eqt)
    {
        $this->em = $em;
        $this->equipmentProvider = $eqt;
    }

    /**
     * Show Equipment
     * @Route("/api/equipment/{id}", name="app.equipment.show", methods={"GET"}, requirements={"id"="\d+"})
     * @param Equipment $equipment
     * @return JsonResponse
     */
    public function showEquipment(Equipment $equipment): JsonResponse
    {
        $data = (array)$this->em->getRepository(Equipment::class)->findOneBy(['id' => $equipment]);
        return $this->json($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/equipments", name="app.equipments", methods={"GET"})
     * @param Request $request
     * @param EquipmentRepository $equipmentRepository
     * @return JsonResponse
     * @throws Exception
     */
    public function showAll(Request $request, EquipmentRepository $equipmentRepository): JsonResponse
    {
        /* Validate request query params and get values */
        $params = $this->equipmentProvider->getQueryParams($request->query->all());
        $equipment = $equipmentRepository->findEquipments($params);

        $response = new JsonResponse();
        $response->setContent(json_encode($equipment));

        return $response;
    }

    /**
     * Delete a Equipment.
     *
     * @Route("/api/equipment/{id}", name="app.equipment.delete", methods={"DELETE"}, requirements={"id"="\d+"})
     * @param Equipment $equipment
     * @return JsonResponse
     *
     */
    public function delete(Equipment $equipment): JsonResponse
    {
        /* Delete Equipment inside database */
        $this->em->remove($equipment);
        $this->em->flush();
        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Create a Equipment.
     *
     * @Route("/api/equipments", name="app.equipment.create", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $demand = $this->equipmentProvider->createEquipment(json_decode($request->getContent(), true));

        $data = $this->outputDataTransformer->transform($demand, '', ['groups' => [Demand::GROUPS['item_read']['name']]]);

        return $this->json($data, Response::HTTP_CREATED, [], ['groups' => [Demand::GROUPS['item_read']['name']]]);
    }
}