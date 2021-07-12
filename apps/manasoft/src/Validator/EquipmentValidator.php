<?php


namespace App\Validator;

use App\Service\InfoCodes;
use Exception;
use App\Entity\Equipment;
use Symfony\Component\HttpFoundation\Response;

class EquipmentValidator implements EquipmentValidatorInterface
{
    /**
     * Validate required $params needed to create a Equipment
     * @param Equipment $equipment
     * @param array $content
     * @return array|void
     * @throws Exception
     */
    public function validateParams(Equipment $equipment, array $content)
    {
        /* 1. If number is not defined */
        if (empty($content['number'])) throw new Exception(InfoCodes::EQUIPMENT_NOT_NUMBER, Response::HTTP_BAD_REQUEST);
        /* 2. If description is not defined */
        elseif (empty($content['description'])) throw new Exception(InfoCodes::EQUIPMENT_NOT_DESCRIPTION, Response::HTTP_BAD_REQUEST);
    }
}