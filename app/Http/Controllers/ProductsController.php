<?php

namespace App\Http\Controllers;

use App\Repositories\ProductsRepository;
use App\Services\ProductsService;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\DeleteProductImageRequest;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    private ProductsRepository $productsRepository;
    private ProductsService $productsService;

    public function __construct(ProductsRepository $productsRepository, ProductsService $productsService)
    {
        $this->productsRepository = $productsRepository;
        $this->productsService = $productsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->productsService->getProductsListAdmin();
        return view('admin.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return Response
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();
        $uploadedImage = !empty($validatedData['image']) ? $validatedData['image'] : null;

        // Save product data
        $product = $this->productsRepository->store($validatedData);

        // Save uploaded image
        if ($uploadedImage !== null)
        {
            $this->productsService->saveImage($validatedData['image'], $product->id);
        }

        return redirect('/admin/products')->with('success', 'Product successfully saved');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productsRepository->getById($id);

        return view('admin.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        $validatedData = $request->validated();

        // Save uploaded image
        if (!empty($validatedData['image']))
        {
            $this->productsService->saveImage($validatedData['image'], $id);
            unset($validatedData['image']);
        }

        $this->productsRepository->getById($id)->update($validatedData);

        return redirect('/admin/products')->with('success', 'Product\'s data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->productsRepository->getById($id)->delete();

        return redirect('/admin/products')->with('success', 'Product successfully deleted');
    }

    /**
     * Remove the specified image of product
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function deleteImage(DeleteProductImageRequest $request, $id)
    {
        $validatedData = $request->validated();
        $imageId = $validatedData['image_id'];

        $success = $this->productsService->deleteProductImage($id, $imageId);

        return response()->json(['success' => $success]);
    }
}
