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
 */
class Products extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }

    /**
     * Get URL of the main product image
     * @return string|null
     */
    public function getMainImageUrlAttribute()
    {
        $mainImageName = $this->images->sortByDesc('main')->first();

        if (!$mainImageName) {
            return null;
        }

        return ProductsService::getImageUrl($mainImageName->image);
    }

    protected static function booted()
    {
        // Cascade deleting product images
        static::deleted(function ($product) {
            $product->images()->delete();
        });
    }
}
