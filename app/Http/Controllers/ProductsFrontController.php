<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;

class ProductsFrontController extends Controller
{
    private ProductsService $service;

    public function __construct(ProductsService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->service->getProductsListFront();
        return view('index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $product = $this->service->getProduct($id);
        return view('product', compact('product'));
    }
}
