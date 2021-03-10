<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'name', 'phone', 'email'];

    /**
     * Get purchases (buyed products data, e.g. count, price, etc) from this order
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases(){
        return $this->hasMany(Purchases::class, 'order_id', 'id');
    }

    /**
     * Get products from this order
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function products(){
        return $this->hasManyThrough(Products::class, Purchases::class, 'order_id', 'id', 'id', 'product_id');
    }
}
