<?php

namespace App\Repository;

use App\Entity\Equipment;
use App\Service\Common\Conf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Config;

/**
 * @method Equipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipment[]    findAll()
 * @method Equipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @codeCoverageIgnore
 */
class EquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipment::class);
    }

    /**
     * @param array $params
     * @return array
     * @throws NonUniqueResultException
     */
    public function getAll(array $params): array
    {
        /* 1. Set variables */
        $max = $params['max'] ?? Conf::MAX_RESULTS;
        $sort = $params['sort'] ?? Equipment::SORTS['date'];
        $order = $params['order'] ?? Conf::DEFAULT_ORDER;
        $offset = $params['offset'] ?? Conf::DEFAULT_INDEX;

        return ['equipments' => $this->getElements($this->findAll(), $offset, $max), 'total' => $this->countElements($this->findAll())];
    }

    private function getElements($qb, $offset, $max)
    {
        return $qb
            ->setFirstResult( ($offset < 0 ? Conf::DEFAULT_INDEX : $offset) )
            ->setMaxResults( ($max <= 0 ? Conf::MAX_RESULTS : $max) )
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @throws NonUniqueResultException
     */
    private function countElements(QueryBuilder $qb)
    {
        $scalar = $qb
            ->select('count(r) total')
            ->getQuery()
            ->setFirstResult(null)
            ->setMaxResults(null)
            ->getOneOrNullResult()
        ;

        return is_null($scalar) ? 0 : $scalar['total'];
    }
}
