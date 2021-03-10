<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Purchases extends Pivot
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'product_count', 'product_price', 'product_title'];
    protected $table = 'purchases';
}
