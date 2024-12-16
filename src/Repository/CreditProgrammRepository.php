<?php

namespace App\Repository;

use App\Entity\CreditProgramm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CreditProgramm>
 *
 * @method CreditProgramm|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditProgramm|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditProgramm[]    findAll()
 * @method CreditProgramm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditProgrammRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditProgramm::class);
    }

    public function add(CreditProgramm $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CreditProgramm $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function getProgrammById($id): ?CreditProgramm
    {
        return $this->find($id); 
    }

    public function getCredicCalc(int $itemPrice, int $initialPayment, int $creditLength){
        $loanAmount = $itemPrice - $initialPayment;

        
        $lowRate = 0;
        $highRate = 1; 
        $tolerance = 0.0001; 
        $maxIterations = 1000; 
        $iterations = 0;

        
        while ($iterations < $maxIterations) {
            $midRate = ($lowRate + $highRate) / 2;
            $monthlyRate = $midRate / 12; 

           
            if ($monthlyRate == 0) {
                $monthlyPayment = $loanAmount / $creditLength;
            } else {
                $monthlyPayment = ($loanAmount * $monthlyRate) / (1 - pow(1 + $monthlyRate, -$creditLength));
            }

          
            $totalPayment = $monthlyPayment * $creditLength;

            
            if ($totalPayment > $loanAmount) {
                $highRate = $midRate; 
            } else {
                $lowRate = $midRate; 
            }

            
            if (abs($totalPayment - $loanAmount) < $tolerance) {
                break;
            }

            $iterations++;
        }

    
        $interestRate = ($lowRate + $highRate) / 2;

        
        $monthlyRate = $interestRate / 12;
        if ($monthlyRate == 0) {
            $monthlyPayment = $loanAmount / $creditLength;
        } else {
            $monthlyPayment = ($loanAmount * $monthlyRate) / (1 - pow(1 + $monthlyRate, -$creditLength));
        }


        $rate=round($interestRate * 100, 2);
        $payments=round($monthlyPayment);
        $title="Ваш кредитный план";

        $program= new CreditProgramm();
        $program->setInterestRate($rate);
        $program->setMonthlyPayment($payments);
        $program->setTitle($title);

        $entityManager->persist($program);
        $entityManager->flush();

        return [
            'programId'=>$product->getId(),
            'interestRate' => $rate, 
            'monthlyPayment' => $payments,
            'title'=>$title
        ];
    }

//    /**
//     * @return CreditProgramm[] Returns an array of CreditProgramm objects
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

//    public function findOneBySomeField($value): ?CreditProgramm
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
