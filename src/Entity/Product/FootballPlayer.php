<?php

namespace App\Entity\Product;

use App\Repository\Product\FootballPlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'l3_FootballPlayer')]
#[ORM\Entity(repositoryClass: FootballPlayerRepository::class)]
class FootballPlayer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $Name = null;

    #[ORM\Column(length: 200)]
    private ?string $FirstName = null;

    #[ORM\Column]
    private ?int $valueMoney = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $CurrentClub = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $CurrentRole = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): static
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getValueMoney(): ?int
    {
        return $this->valueMoney;
    }

    public function setValueMoney(int $valueMoney): static
    {
        $this->valueMoney = $valueMoney;

        return $this;
    }

    public function getCurrentClub(): ?string
    {
        return $this->CurrentClub;
    }

    public function setCurrentClub(?string $CurrentClub): static
    {
        $this->CurrentClub = $CurrentClub;

        return $this;
    }

    public function getCurrentRole(): ?string
    {
        return $this->CurrentRole;
    }

    public function setCurrentRole(?string $CurrentRole): static
    {
        $this->CurrentRole = $CurrentRole;

        return $this;
    }
}
