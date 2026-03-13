<?php

namespace App\Domain\Product;

use App\Domain\Product\Command\CreateProduct;
use App\Domain\Product\Event\ProductWasCreated;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\Distributed;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\WithAggregateVersioning;
use Ramsey\Uuid\Uuid;

#[EventSourcingAggregate]
class Product
{
    const CREATE_PRODUCT_PRODUCT = "product.createProduct";

    use WithAggregateVersioning;

    #[AggregateIdentifier]
    private string $productId;

    private string $name;

    private int $price;

    #[Distributed]
    #[CommandHandler(self::CREATE_PRODUCT_PRODUCT)]
    public static function create(CreateProduct $command): array
    {
        return [
            new ProductWasCreated(
                Uuid::uuid4()->toString(),
                $command->name,
                $command->price
            )
        ];
    }

    #[EventSourcingHandler]
    public function applyProductWasCreated(ProductWasCreated $event): void
    {
        $this->productId = $event->productId;
        $this->name = $event->name;
        $this->price  = $event->price;
    }
}
