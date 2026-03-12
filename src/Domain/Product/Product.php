<?php

namespace App\Domain\Product;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Ecotone\Modelling\Attribute\Aggregate;
use Ecotone\Modelling\Attribute\AggregateIdentifier;

#[ORM\Entity]
#[Aggregate]
#[Table("products")]
class Product
{
    #[ORM\Id]
    #[AggregateIdentifier]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"string",unique: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }
}
