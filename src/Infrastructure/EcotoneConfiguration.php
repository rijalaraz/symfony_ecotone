<?php

namespace App\Infrastructure;

use App\Domain\Product\Product;
use Ecotone\Dbal\Configuration\DbalConfiguration;
use Ecotone\Messaging\Attribute\ServiceContext;
use Ecotone\SymfonyBundle\Config\SymfonyConnectionReference;

final readonly class EcotoneConfiguration
{
    #[ServiceContext()]
    public function dbalConfiguration()
    {
        // return SymfonyConnectionReference::defaultConnection('default');
        return DbalConfiguration::createWithDefaults()
            ->withDoctrineORMRepositories(
                true,
                // [
                //     Product::class
                // ]
            )
            // managed by php bin/console ecotone:migration:database:setup
            ->withAutomaticTableInitialization(false)
        ;
    }
}