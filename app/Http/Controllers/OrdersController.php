<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\CreateOrderRequest;
use App\Services\OrdersService;

class OrdersController extends Controller
{
    protected OrdersService $service;

    public function __construct(OrdersService $ordersService)
    {
        $this->service = $ordersService;
    }

    public function store(CreateOrderRequest $request)
    {
        $data = $request->validated();
        $order = $this->service->createOrder($data);
        return redirect(route('created_order', ['id' => $order->id]))->with('success', 'Order successfully created');
    }

    /*public function testStore()
    {
        $ordersData = [
            'status' => 1,
            'name' => 'Test customer',
            'phone' => '+12345678901'
        ];
        $order = Orders::create($ordersData);

        $purchasesData = [
            [
                'product_id' => 6,
                'count' => 1,
                'product_price' => 20
            ],
            [
                'product_id' => 8,
                'count' => 2,
                'product_price' => 8
            ]
        ];
        $order->purchases()->createMany($purchasesData);
    }*/

//    public function getPurchases($id)
//    {
//        $order = Orders::findOrFail($id);
//        dd($order->purchases()->get());
//    }
//
//    public function getProducts($id)
//    {
//        $order = Orders::findOrFail($id);
//        dd($order->products()->get());
//    }

    public function showCreated($id)
    {
        $order = $this->service->getOrder($id);
        return view('order_created', ['order' => $order]);
    }
}
