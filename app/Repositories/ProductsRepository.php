<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;
use App\Models\Products;

class ProductsRepository
{
    public const PRODUCT_IMAGE_DIR = '/images/products';

    public function getProducts()
    {
        return Products::with('images')->get(['id', 'title', 'price']);

//        $productsQuery = Products::where("id", 1);
//        $productsQuery->orWhere("id", 2);
//        $products = $productsQuery->get();
//        return $products;

//        $products = Products::get();
//        $products->loadMissing('images');
//        return $products;
    }

    public function getProductsByIdsWithImages($ids, $columns = ['*'])
    {
        return Products::with('images')->whereIn('id', $ids)->get($columns);
    }

    /**
     * @param $id
     * @return Products
     */
    public function getById($id)
    {
        return Products::find($id);
    }

    public function filterIdsByExisting(array $ids)
    {
        return Products::whereIn('id', $ids)->pluck('id');
    }

    public function store($data)
    {
        return Products::create($data);
    }

    /**
     * Save image to storage
     * @param \Illuminate\Http\UploadedFile $image
     * @return string
     */
    public function storeImage(UploadedFile $image)
    {
        $storedImagePath = $image->store(self::PRODUCT_IMAGE_DIR, 'public');
        return basename($storedImagePath);
    }
}
