<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 5);
        $page = $request->get('page', 1);

        $products = Product::orderBy('created_at', 'asc')->paginate($perPage, ['*'], 'page', $page);
        $data['products'] = $products->items();

        $data['meta'] = [
            'page' => $products->currentPage(),
            'per_page' => $products->perPage(),
            'total_pages' => $products->lastPage(),
            'total_count' => $products->total(),
        ];

        return $this->successResponse($data, 'Products retrieved successfully.');
    }

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
        $product = Product::create($validated);

        return $this->successResponse($product, 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return $this->successResponse($product, 'Product retrieved successfully.');
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);

        return $this->successResponse($product, 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return $this->successResponse(null, 'Product deleted successfully.');
    }
}
