<?php

namespace App\Domain\Product;

use App\Domain\Product\Command\CreateProduct;
use App\Domain\Product\Event\ProductWasCreated;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\Distributed;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\WithAggregateVersioning;
use Ramsey\Uuid\Uuid;

#[ORM\Entity]
#[Table("products")]
#[EventSourcingAggregate]
class Product
{
    const CREATE_PRODUCT_PRODUCT = "product.createProduct";

    use WithAggregateVersioning;

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

    #[EventSourcingHandler]
    public function applyProductWasCreated(ProductWasCreated $event): void
    {
        $this->productId = $event->productId;
        $this->name = $event->name;
        $this->price  = $event->price;
    }
}
