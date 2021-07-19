<?php

namespace App\Service\Equipment;

use App\Entity\Equipment;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface EquipmentProviderInterface
 */
interface EquipmentProviderInterface
{
    public function createEquipment(Request $request);

    public function getEquipment(Equipment $equipment);

    public function deleteEquipment(Equipment $equipment);

    public function updateEquipment(Equipment $equipment, Request $request);
}