<?php

namespace App\Models;

use App\Services\ProductsService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Products
 * @package App\Models
 *
 * @property-read string|null $imageUrl
 * @property-read array $additionalImages
 */
class ProductImages extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['product_id', 'image', 'main'];

    public function getImageUrl()
    {
        return ProductsService::getImageUrl($this->image);
    }
}
