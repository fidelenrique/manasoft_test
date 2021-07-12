<?php


namespace App\Validator;

use App\Entity\Equipment;

interface EquipmentValidatorInterface
{
    /**
     * @param Equipment $equipment
     * @param array $content
     * @return array|void
     */
    public function validateParams(Equipment $equipment, array $content);
}