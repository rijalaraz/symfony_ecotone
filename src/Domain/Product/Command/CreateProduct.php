<?php

namespace App\Domain\Product\Command;

final readonly class CreateProduct
{
    public function __construct(
        public ?string $productId = null,
        public string $name,
        public int $price
    ){}
}
