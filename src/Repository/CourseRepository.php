<?php

namespace App\Repository;

use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

/**
 * @extends ServiceEntityRepository<Course>
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Course::class);
    }

    public function getCoursesPaginator(): Pagerfanta
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery('SELECT c FROM App\Entity\Course c');

        return new Pagerfanta(new QueryAdapter($query));
    }
}
