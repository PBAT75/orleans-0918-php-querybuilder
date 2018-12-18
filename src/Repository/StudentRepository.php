<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Student::class);
    }

    /**
     * @return Student[] Returns an array of Student objects
     *
     */
    public function findAgeGreaterThan(int $age)
    {
        return $this->createQueryBuilder('s')
            ->where('s.age > :age')
            ->setParameter('age', $age)
            ->getQuery()
            ->getResult();
    }

    public function findLikeFirstname(string $search)
    {
        return $this->createQueryBuilder('s')
            ->where('s.firstname LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult();
    }

    public function findLikeFullname(string $search)
    {
        return $this->createQueryBuilder('s')
            ->where('s.firstname LIKE :search')
            ->orWhere('s.lastname LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->orderBy('s.firstname', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findInSchool(string $search)
    {
        return $this->createQueryBuilder('s')
            ->join('s.school', 'sc')
            ->where('sc.name LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult();
    }

}
