<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 5);
        $page = $request->get('page', 1);

        $products = Product::with(['category', 'supplier'])
                        ->orderBy('id', 'asc')
                        ->paginate($perPage, ['*'], 'page', $page);

        $data['products'] = ProductResource::collection($products->items());

        $data['meta'] = [
            'current_page' => $products->currentPage(),
            'per_page' => $products->perPage(),
            'total_pages' => $products->lastPage(),
            'total_count' => $products->total(),
        ];

        return $this->successResponse($data);
    }

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
        $product = Product::create($validated);

        return $this->successResponse(new ProductResource($product));
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return $this->successResponse(new ProductResource($product));
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);

        return $this->successResponse(new ProductResource($product));
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return $this->successResponse(null);
    }
}
