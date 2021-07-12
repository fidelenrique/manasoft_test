<?php

namespace App\Service\Equipment;

use App\Entity\Equipment;
use App\Service\InfoCodes;
use Doctrine\DBAL\Exception;
use Symfony\Component\HttpFoundation\Response;

class EquipmentProvider implements EquipmentProviderInterface
{
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

    public function createEquipment()
    {

    }
}