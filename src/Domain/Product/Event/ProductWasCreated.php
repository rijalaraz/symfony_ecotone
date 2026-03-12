<?php

namespace App\Domain\Product\Event;

final class ProductWasCreated
{
    public function __construct(
        public string $productId,
        public string $name,
        public int $price,
    ){}
}
