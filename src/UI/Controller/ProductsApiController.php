<?php

namespace App\UI\Controller;

use App\Domain\Product\Product;
use Ecotone\Modelling\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductsApiController extends AbstractController
{
    public function __construct(
        private CommandBus $commandBus
    ) {}

    #[Route('/api/products', methods:['POST'])]
    public function createAction(Request $request): JsonResponse
    {
        $productId = $this->commandBus->sendWithRouting(
            Product::CREATE_PRODUCT_PRODUCT,
            $request->getContent(),
            "application/json",
        );

        return $this->json([
            'message' => 'Product created successfully!',
            'data' => [
                'productId' => $productId
            ]
        ], Response::HTTP_CREATED);
    }
}
