<?php

namespace App\Entity;

use App\Repository\CreditReqRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreditReqRepository::class)
 */
class CreditReq
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CreditProgramm::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $programm_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $initial_payment;

    /**
     * @ORM\Column(type="integer")
     */
    private $loan_term;

    /**
     * @ORM\ManyToOne(targetEntity=Car::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $car_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgrammId(): ?CreditProgramm
    {
        return $this->programm_id;
    }

    public function setProgrammId(?CreditProgramm $programm_id): self
    {
        $this->programm_id = $programm_id;

        return $this;
    }

    public function getInitialPayment(): ?int
    {
        return $this->initial_payment;
    }

    public function setInitialPayment(int $initial_payment): self
    {
        $this->initial_payment = $initial_payment;

        return $this;
    }

    public function getLoanTerm(): ?int
    {
        return $this->loan_term;
    }

    public function setLoanTerm(int $loan_term): self
    {
        $this->loan_term = $loan_term;

        return $this;
    }

    public function getCarId(): ?Car
    {
        return $this->car_id;
    }

    public function setCarId(?Car $car_id): self
    {
        $this->car_id = $car_id;

        return $this;
    }
}
