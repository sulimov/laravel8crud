<?php

namespace App\Repositories;

use App\Services\CartService;

class CartRepository
{
    public const MAX_PRODUCT_COUNT = 100000;

    public function getCart() : array
    {
        $cart = session('cart', []);

        if (is_string($cart)){
            $cart = json_decode($cart, true);
        }

        return $cart;
    }

    /**
     * Add product to cart
     * @param int $product_id
     * @param int $count
     * @return bool
     */
    public function add(int $product_id, int $count): bool
    {
        $cart = $this->getCart();

        if (!isset($cart[$product_id])){
            $cart[$product_id] = $count;
        } else {
            // The total should not exceed MAX_PRODUCT_COUNT
            if ($cart[$product_id] + $count > self::MAX_PRODUCT_COUNT){
                $cart[$product_id] = self::MAX_PRODUCT_COUNT;
            } else {
                $cart[$product_id] += $count;
            }
        }

        $this->set($cart);

        return true;
    }

    public function set(array $cart)
    {
        session()->put('cart', json_encode($cart));
    }

    public function validatedCart(array $cart, bool $allowCartUpdate = false): array
    {
        $needCartUpdate = false;

        foreach ($cart as $productId => $count)
        {
            if (!$this->validateProduct($productId, $count)){
                unset($cart[$productId]);

                if ($allowCartUpdate){
                    $needCartUpdate = true;
                }
            }

            // TODO: check product residue
        }

        if ($allowCartUpdate && $needCartUpdate){
            $this->set($cart);
        }

        return $cart;
    }

    // TODO: failed validation to errors()
    public function validateProduct(int $productId, int $count)
    {
        /** @var CartService $service */
        $product = app(ProductsRepository::class)->getById($productId);
        if ($product === null){
            return false;
        }

        // TODO: check product residue

        return true;
    }
}
