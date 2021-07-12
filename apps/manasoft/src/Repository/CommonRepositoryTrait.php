<?php

namespace App\Repository;

use App\Service\Common\Conf;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;

trait CommonRepositoryTrait
{
    public function getElements($qb, $offset, $max)
    {
        return $qb
            ->setFirstResult($offset < 0 ? Conf::DEFAULT_INDEX : $offset)
            ->setMaxResults($max <= 0 ? Conf::MAX_RESULTS : $max)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function countElements(QueryBuilder $qb, string $alias)
    {
        $scalar = $qb
            ->select('count('. $alias .') total')
            ->getQuery()
            ->setFirstResult(null)
            ->setMaxResults(null)
            ->getOneOrNullResult()
        ;

        return is_null($scalar) ? 0 : $scalar['total'];
    }
}
