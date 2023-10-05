<?php

namespace App\Repository;

use App\Entity\Plush;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Plush>
 *
 * @method Plush|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plush|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plush[]    findAll()
 * @method Plush[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlushRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plush::class);
    }

    public function findAllExcept($plushId)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id != :plushId')
            ->setParameter('plushId', $plushId)
            ->getQuery()
            ->getResult();
    }
}
