<?php

namespace App\Repository;

use App\Entity\Todolist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Todolist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Todolist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Todolist[]    findAll()
 * @method Todolist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodolistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Todolist::class);
    }

    // /**
    //  * @return Todolist[] Returns an array of Todolist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Todolist
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
