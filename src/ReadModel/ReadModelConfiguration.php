<?php

namespace App\ReadModel;

use Ecotone\Dbal\DbalBackedMessageChannelBuilder;
use Ecotone\Messaging\Attribute\ServiceContext;

final class ReadModelConfiguration
{
    const ASYNCHRONOUS_PROJECTIONS_CHANNEL = "asynchronous_projections";

    #[ServiceContext]
    public function getConfiguration()
    {
        return [
            DbalBackedMessageChannelBuilder::create(self::ASYNCHRONOUS_PROJECTIONS_CHANNEL)
        ];
    }
}
