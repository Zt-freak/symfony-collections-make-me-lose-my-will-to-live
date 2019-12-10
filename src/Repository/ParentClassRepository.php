<?php

namespace App\Repository;

use App\Entity\ParentClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ParentClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParentClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParentClass[]    findAll()
 * @method ParentClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParentClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParentClass::class);
    }

    // /**
    //  * @return ParentClass[] Returns an array of ParentClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParentClass
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
