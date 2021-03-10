<?php

namespace App\Services;

use App\Repositories\ProductsRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductsService
{
    protected ProductsRepository $repository;

    public function __construct(ProductsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getProductsListAdmin()
    {
        return $this->repository->getProducts();
    }

    public function getProductsListFront()
    {
        return $this->repository->getProducts();
    }

    public function getProduct($id)
    {
        return $this->repository->getById($id);
    }

    /**
     * @param UploadedFile $image
     * @param $productId
     */
    public function saveImage($image, $productId)
    {
        // Store image
        $imageName = $this->repository->storeImage($image);

        $product = $this->repository->getById($productId);
        // Determine is image main
        $numberOfStoredImages = $product->images()->where('product_id', $productId)->count();
        $isMain = $numberOfStoredImages > 0 ? 0 : 1;

        $product->images()->create(['image' => $imageName, 'main' => $isMain]);
    }

    /**
     * @param string $name
     * @return string
     */
    public static function getImageUrl(string $name): string
    {
        return Storage::disk('public')->url(ProductsRepository::PRODUCT_IMAGE_DIR . '/' . $name);
    }

    /**
     * @param int $productId
     * @param int $imageId
     * @return int
     */
    public function deleteProductImage(int $productId, int $imageId): int
    {
        $product = $this->repository->getById($productId);
        return $product->images()->where('id', $imageId)->delete();
    }

    public function verifyProductIds(array $productIds)
    {
        return $this->repository->filterIdsByExisting($productIds);
    }
}
