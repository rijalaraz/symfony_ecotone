<?php

namespace App\Domain\Product;

use App\Domain\Product\Command\CreateProduct;
use App\Domain\Product\Event\ProductWasCreated;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Ecotone\Modelling\Attribute\Aggregate;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\Distributed;
use Ramsey\Uuid\Uuid;

#[ORM\Entity]
#[Table("products")]
#[Aggregate]
class Product
{
    const CREATE_PRODUCT_PRODUCT = "product.createProduct";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"string",unique: true)]
    #[AggregateIdentifier]
    private string $productId;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private int $price;

    #[Distributed]
    #[CommandHandler(self::CREATE_PRODUCT_PRODUCT)]
    public static function create(CreateProduct $command): array
    {
        return [
            new ProductWasCreated(
                $command->productId ?: Uuid::uuid4()->toString(),
                $command->name,
                $command->price
            )
        ];
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
