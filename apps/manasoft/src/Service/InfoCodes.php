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

    const NOT_FOUND_NUMBER = 'EQPNFNU';
    const EQUIPMENT_NOT_NUMERIC = 'EQPNONU';
    const NOT_FOUND_NAME = 'EQPNONA';
    const NOT_FOUND_CATEGORY = 'EQPNOCA';
}