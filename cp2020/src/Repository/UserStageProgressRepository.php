<?php

namespace App\Repository;

use App\Entity\UserStageProgress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserStageProgress|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserStageProgress|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserStageProgress[]    findAll()
 * @method UserStageProgress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserStageProgressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserStageProgress::class);
    }

    public function findByUserId($id) {

        return $this->createQueryBuilder('p')
            ->join('p.User', 'u')
            ->andWhere('u.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return UserStageProgress[] Returns an array of UserStageProgress objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserStageProgress
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
