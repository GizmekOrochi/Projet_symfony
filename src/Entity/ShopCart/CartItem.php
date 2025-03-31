<?php

// src/Entity/CartItem.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product\FootballPlayer;

#[ORM\Table(name: 'l3_CartItem')]
#[ORM\Entity]
class CartItem
{
#[ORM\Id]
#[ORM\GeneratedValue]
#[ORM\Column(type: "integer")]
private ?int $id = null;

#[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: "items")]
#[ORM\JoinColumn(nullable: false)]
private Cart $cart;

#[ORM\ManyToOne(targetEntity: FootballPlayer::class)]
#[ORM\JoinColumn(nullable: false)]
private FootballPlayer $product;

}
