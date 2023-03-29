<?php

namespace App\Repository;

use App\Entity\RemainingPlaces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RemainingPlaces>
 *
 * @method RemainingPlaces|null find($id, $lockMode = null, $lockVersion = null)
 * @method RemainingPlaces|null findOneBy(array $criteria, array $orderBy = null)
 * @method RemainingPlaces[]    findAll()
 * @method RemainingPlaces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemainingPlacesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RemainingPlaces::class);
    }

    public function save(RemainingPlaces $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RemainingPlaces $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RemainingPlaces[] Returns an array of RemainingPlaces objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RemainingPlaces
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
