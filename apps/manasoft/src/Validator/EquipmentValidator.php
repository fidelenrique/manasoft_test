<?php


namespace App\Validator;

use App\Service\InfoCodes;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class EquipmentValidator implements EquipmentValidatorInterface
{
    /**
     * Validate required $params needed to create a Equipment
     * @param array $content
     * @throws Exception
     */
    public function validateParams(array $content)
    {
        /* 1. If number is not defined */
        if (empty($content['number'])) throw new Exception(InfoCodes::NOT_FOUND_NUMBER, Response::HTTP_BAD_REQUEST);
        /* 1. If number is not numeric */
        if (!is_numeric($content['number'])) throw new Exception(InfoCodes::EQUIPMENT_NOT_NUMERIC, Response::HTTP_BAD_REQUEST);

        /* 2. If name is not defined */
        elseif (empty($content['name'])) throw new Exception(InfoCodes::NOT_FOUND_NAME, Response::HTTP_BAD_REQUEST);
        /* 3. If category is not defined */
        elseif (empty($content['category'])) throw new Exception(InfoCodes::NOT_FOUND_CATEGORY, Response::HTTP_BAD_REQUEST);
    }
}
