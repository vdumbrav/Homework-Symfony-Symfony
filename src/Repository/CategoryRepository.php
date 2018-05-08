<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findCategoriesWithActiveJobs()
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->innerJoin('c.jobs', 'j')
            ->andWhere('j.activated = :active')
            ->andWhere('j.expiresAt > :datetime')
            ->setParameters([
                'active' => true,
                'datetime' => new \DateTime(),
            ])
            ->addOrderBy('c.name', 'ASC')
            ->addOrderBy('j.expiresAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
