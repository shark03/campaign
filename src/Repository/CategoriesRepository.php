<?php

namespace App\Repository;


use App\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Categories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categories[]    findAll()
 * @method Categories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Categories::class);
    }

    public function listParentCategories($limit = 10,$returnJson = false){
        $em = $this->getEntityManager();
        $qb = $em->getRepository("App:Categories")->createQueryBuilder("c");

        $qb->where($qb->expr()->isNull('c.parent'));
        $qb->andWhere($qb->expr()->eq('c.categoryStatus',':categoryStatus'))->setParameter('categoryStatus',true);
        $qb->setMaxResults($limit);
        $qb->orderBy("c.categoryOrder","ASC");

        if($returnJson === true){
            return json_encode($qb->getQuery()->getArrayResult());
        }
        return $qb->getQuery()->getResult();
    }

    public function listAllCategoriesExcludeSlug($excludeCategorySlug){
        $em = $this->getEntityManager();
        $qb = $em->getRepository("App:Categories")->createQueryBuilder("c");

        $qb->where($qb->expr()->isNull('c.parent'));
        $qb->andWhere($qb->expr()->eq('c.categoryStatus',':categoryStatus'))->setParameter('categoryStatus',true);
        $qb->andWhere($qb->expr()->neq('c.categorySlug',':excludeCategorySlug'))->setParameter('excludeCategorySlug',$excludeCategorySlug);
        $qb->orderBy("c.categoryOrder","ASC");

        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return Categories[] Returns an array of Categories objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categories
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
