<?php

namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CreditReq>
 *
 * @method CreditReq|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditReq|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditReq[]    findAll()
 * @method CreditReq[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditReqRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditReq::class);
    }

    public function save(Car $carId, CreditProgramm $programId, int $payment, int $term ):bool{
        $req= new CreditReq();
        $req->setProgrammId($programId);
        $req->setCarId($carId);
        $req->setInitialPayment($payment);
        $req->setLoanTerm($term);

        $entityManager = $this->getEntityManager();
        try {
            $entityManager->persist($req);
            $entityManager->flush();
            return true; 
        } catch (Exception $e) {
            return false; 
        }
    }

    public function add(CreditReq $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CreditReq $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CreditReq[] Returns an array of CreditReq objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CreditReq
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
