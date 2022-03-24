<?php

namespace App\Repository;

use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    public function findPublished()
    {
        return $this->createQueryBuilder('o')
            ->where('o.isPublished = true AND o.dateStart <= CURRENT_DATE() AND o.dateEnd >= CURRENT_DATE()')
            ->orderBy('o.dateStart', 'DESC')
            ->getQuery()
            ->getResult();
    }
}