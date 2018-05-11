<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Symfony\Bridge\Doctrine\RegistryInterface;


class JobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }

    /**
     * @return Job[]
     */
    public function findActiveJob()
    {
        return $this->createQueryBuilder('job')
            ->where('job.expiresAt > :date')
            ->setParameter('date', new \DateTime())
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Category $category
     * @return AbstractQuery
     */
    public function getPaginatedActiveJobsByCategoryQuery(Category $category): AbstractQuery
    {
        return $this->createQueryBuilder('job')
            ->where('job.category = :category')
            ->andWhere('job.expiresAt > :date')
            ->andWhere('job.activated = :activated')
            ->setParameters([
                'category' => $category,
                'date' => new \DateTime(),
                'activated' => true,
            ])
            ->getQuery();
    }
}
