<?php

namespace App\Services;

use App\Models\Products;
use App\Repositories\ProductsRepository;
use App\Repositories\CartRepository;

class CartService
{
    protected CartRepository $repository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->repository = $cartRepository;
    }

    /**
     * @return array
     */
    public function getCart(): array
    {
        return $this->repository->getCart();
    }

    /**
     * Add product to cart
     * @param int $product_id
     * @param int $count
     * @return bool
     */
    public function addProduct(int $product_id, int $count): bool
    {
        return $this->repository->add($product_id, $count);
    }

    public function deleteProduct(int $product_id)
    {
        $cart = $this->repository->getCart();

        if (isset($cart[$product_id])){
            unset($cart[$product_id]);

            $this->repository->set($cart);
        }
    }

    public function setCart(array $cart, $validate = false)
    {
        if ($validate){
            $cart = $this->repository->validatedCart($cart);
        }

        $this->repository->set($cart);

        return true;
    }

    public function clearCart()
    {
        $this->repository->set([]);
    }

    /**
     * Get cart with product data
     * @return array
     */
    public function getResolvedCartArray() : array
    {
        $cart = $this->repository->getCart();

        if (empty($cart)){
            return $cart;
        }

        $notResolvedCart = $cart;

        // Get product data and attach it to return value
        $resolvedCartArray = [];

        $productsFromDb = app(ProductsRepository::class)->getProductsByIdsWithImages(array_keys($cart), ['id', 'title', 'price']);

        foreach ($productsFromDb as $productObject){
            /** @var Products $productObject */
            $productId = $productObject->id;

            $resolvedCartArray[$productId] = [
                'data' => $productObject,
                'count' => $cart[$productId]
            ];

            unset($notResolvedCart[$productId]);
        }

        // "Orphan" products found
        if (!empty($notResolvedCart)){
            foreach ($notResolvedCart as $key => $value){
                unset($cart[$key]);
            }

            // Update cart
            $this->setCart($cart);
        }

        return $resolvedCartArray;
    }

    /**
     * @return int
     */
    public function getCartProductsCount()
    {
        $cart = $this->repository->getCart();

        if (empty($cart)){
            return 0;
        }

        // If cart page retrieved there is cart validation already done
        if (app('request')->route()->named('cart')){
           return count($cart);
        } else {
            // Validate products
            $ids = array_keys($cart);
            $existingIds = app(ProductsService::class)->verifyProductIds($ids);
            return count($existingIds);
        }
    }
}
