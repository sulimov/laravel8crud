<?php

namespace App\Http\View\Composers;

use App\Services\CartService;
use Illuminate\View\View;

class FrontComposer
{
    /**
     * The cart repository implementation.
     *
     * @var CartService
     */
    protected CartService $cartService;

    /**
     * Create a new profile composer.
     *
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        // Work with views from current directory only
        if (strpos($view->getName(), '.') === false){
            $view->with('cartProductsCount', $this->cartService->getCartProductsCount());
        }
    }
}
