<?php

// src/Entity/Cart.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\User;

#[ORM\Table(name: 'l3_Cart')]
#[ORM\Entity]
class Cart
{
#[ORM\Id]
#[ORM\GeneratedValue]
#[ORM\Column(type: "integer")]
private ?int $id = null;

#[ORM\OneToOne(targetEntity: User::class)]
#[ORM\JoinColumn(nullable: false)]
private User $user;

#[ORM\OneToMany(mappedBy: "cart", targetEntity: CartItem::class, cascade: ["persist", "remove"])]
private Collection $items;

public function __construct()
{
$this->items = new ArrayCollection();
}

// Getters and setters...
}
