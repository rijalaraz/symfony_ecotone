<?php

namespace App\Domain\Product\Event;

final readonly class ProductWasCreated
{
    public function __construct(
        public string $productId,
        public string $name,
        public int $price,
    ){}
}
