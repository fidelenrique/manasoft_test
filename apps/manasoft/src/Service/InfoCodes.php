<?php

namespace App\Service;

/**
 * Class InfoCodes
 * @package App\Service
 * @codeCoverageIgnore
 */
abstract class InfoCodes
{
    const
        EQUIPMENT_WRONG_SORTS = 'EQPWRSO'
    ;

    const RES_NOT_FOUND = 'RSCNFND';
    const EQUIPMENT_NOT_FOUND = 'EQPNFND';

    const EQUIPMENT_NOT_NUMBER = 'EQPNONU';
    const EQUIPMENT_NOT_DESCRIPTION = 'EQPNODE';
}