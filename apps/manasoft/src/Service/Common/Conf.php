<?php


namespace App\Service\Common;

abstract class Conf
{
    ###> DATABASES <###
    public const DEFAULT_INDEX = 0;
    public const DEFAULT_ORDER = "DESC";
    public const DB_ORDERS = ["ASC", "DESC"];
    public const MAX_RESULTS = 30;
}