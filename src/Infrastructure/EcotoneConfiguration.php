<?php

namespace App\Infrastructure;

use Ecotone\Messaging\Attribute\ServiceContext;
use Ecotone\SymfonyBundle\Config\SymfonyConnectionReference;

final readonly class EcotoneConfiguration
{
    #[ServiceContext()]
    public function dbalConfiguration()
    {
        return SymfonyConnectionReference::defaultConnection('default');
    }
}