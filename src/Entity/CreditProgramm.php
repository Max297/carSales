<?php

namespace App\Entity;

use App\Repository\CreditProgrammRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreditProgrammRepository::class)
 */
class CreditProgramm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $interest_rate;

    /**
     * @ORM\Column(type="integer")
     */
    private $monthly_payment;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInterestRate(): ?float
    {
        return $this->interest_rate;
    }

    public function setInterestRate(float $interest_rate): self
    {
        $this->interest_rate = $interest_rate;

        return $this;
    }

    public function getMonthlyPayment(): ?int
    {
        return $this->monthly_payment;
    }

    public function setMonthlyPayment(int $monthly_payment): self
    {
        $this->monthly_payment = $monthly_payment;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
