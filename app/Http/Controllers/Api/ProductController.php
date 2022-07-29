<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderByDesc('id')->get();

        return response()->json($product);
    }

    public function store(ProductRequest $request): JsonResource
    {
        $product = new Product();
        $product->fill($request->all());
        $product->save();

        return new ProductResource($product);
    }

    public function show(Product $product): JsonResource
    {
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product): JsonResource
    {
        $product->update($request->all());

        return new ProductResource($product);
    }

    public function destroy(Product $product): JsonResource
    {
        $product->delete();

        return new ProductResource($product);
    }
}
