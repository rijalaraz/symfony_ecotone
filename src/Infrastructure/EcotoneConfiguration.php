<?php

namespace App\Infrastructure;

use Ecotone\Dbal\Configuration\DbalConfiguration;
use Ecotone\Messaging\Attribute\ServiceContext;
use Ecotone\SymfonyBundle\Config\SymfonyConnectionReference;

final readonly class EcotoneConfiguration
{
    #[ServiceContext()]
    public function dbalConfiguration()
    {
        // return SymfonyConnectionReference::defaultConnection('doctrine');
        return DbalConfiguration::createWithDefaults()
            ->withDoctrineORMRepositories(
                true,
                //[Article::class]
            )
        ;
    }
}