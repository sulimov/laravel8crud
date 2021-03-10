<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\DeleteProductFromCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;

use App\Services\CartService;

class CartController extends Controller
{
    protected CartService $service;

    public function __construct(CartService $cartService)
    {
        $this->service = $cartService;
    }

    public function show()
    {
        $cart = $this->service->getResolvedCartArray();
        return view('cart')->with('cart', $cart);
    }

    public function add(AddToCartRequest $request)
    {
        $validatedData = $request->validated();
        $this->service->addProduct($validatedData['product_id'], $validatedData['count']);

        return redirect(route('cart'))->with('success', 'Product successfully added to cart');
    }

    public function deleteProduct(DeleteProductFromCartRequest $request)
    {
        $validatedData = $request->validated();
        $this->service->deleteProduct($validatedData['product_id']);

        return redirect(route('cart'))->with('success', 'Product successfully deleted from cart');
    }

    public function update(UpdateCartRequest $request)
    {
        $validatedData = $request->validated();

        if ($this->service->setCart($validatedData['cart'], true)){
            $status = 'success';
            $msg = 'Cart successfully updated';
        } else {
            $status = 'error';
            $msg = 'Error while updating the cart. Please try again';
        }

//        return redirect(route('cart'))->with($status, $msg);
        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    public function showCheckout()
    {
        $cart = $this->service->getResolvedCartArray();
        return view('checkout')->with('cart', $cart);
    }
}
