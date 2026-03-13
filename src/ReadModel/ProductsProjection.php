<?php

namespace App\ReadModel;

use App\Domain\Product\Event\ProductWasCreated;
use App\Domain\Product\Product;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Types;
use Ecotone\EventSourcing\Attribute\Projection;
use Ecotone\EventSourcing\Attribute\ProjectionInitialization;
use Ecotone\Messaging\Attribute\Asynchronous;
use Ecotone\Modelling\Attribute\EventHandler;

#[Asynchronous(ReadModelConfiguration::ASYNCHRONOUS_PROJECTIONS_CHANNEL)]
#[Projection("products", Product::class)]
final class ProductsProjection
{
    const TABLE_NAME = "products";

    public function __construct(
        private Connection $connection
    ){}

    #[EventHandler]
    public function onProductWasCreated(ProductWasCreated $event) : void
    {
        $this->connection->insert(self::TABLE_NAME, [
            "product_id" => $event->productId,
            "name" => $event->name,
            "price" => $event->price
        ]);
    }

    #[ProjectionInitialization]
    public function initializeProjection() : void
    {
        if ($this->connection->createSchemaManager()->tablesExist(self::TABLE_NAME)) {
            return;
        }

        $table = new Table(self::TABLE_NAME);

        $table->addColumn('product_id', Types::STRING);
        $table->addColumn('name', Types::STRING);
        $table->addColumn('price', Types::INTEGER);

        $table->setPrimaryKey(['product_id']);

        $table->addUniqueIndex(['product_id']);

        $this->connection->createSchemaManager()->createTable($table);
    }
}
