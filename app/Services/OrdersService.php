<?php

namespace App\Services;

use App\Repositories\OrdersRepository;

class OrdersService
{
    protected OrdersRepository $repository;

    public const STATUS_PENDING = 1;

    public function __construct(OrdersRepository $cartRepository)
    {
        $this->repository = $cartRepository;
    }

    public function createOrder(array $data)
    {
        // Order
        $data['status'] = self::STATUS_PENDING;
        $order = $this->repository->create($data);

        // Purchases
        /** @var CartService $cartService */
        $cartService = app(CartService::class);
        $cart = $cartService->getCart();

        $purchasesData = [];
        foreach ($cart as $productId => $count) {
            $product = app(ProductsService::class)->getProduct($productId);
            $purchasesData[] = [
                'product_id' => $productId,
                'product_count' => $count,
                'product_price' => $product->price,
                'product_title' => $product->title
            ];
        }

        $order->purchases()->createMany($purchasesData);

        // Clear cart
        $cartService->clearCart();

        return $order;
    }

    public function getOrder(int $orderId)
    {
        return $this->repository->getById($orderId);
    }

}
