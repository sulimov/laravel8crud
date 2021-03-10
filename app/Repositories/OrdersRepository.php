<?php

namespace App\Repositories;

use App\Models\Orders;

class OrdersRepository
{
    /**
     * @param $id
     * @return Orders
     */
    public function getById($id)
    {
        return Orders::find($id);
    }

    /**
     * @param array $data
     * @return Orders
     */
    public function create(array $data): Orders
    {
        return Orders::create($data);
    }
}
