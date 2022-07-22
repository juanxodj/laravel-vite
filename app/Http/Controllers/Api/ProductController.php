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
        $cash = Product::paginate(10);

        return response()->json($cash);
    }

    public function store(ProductRequest $request): JsonResource
    {
        $cash = new Product();
        $cash->fill($request->all());
        $cash->save();

        return new ProductResource($cash);
    }

    public function show(Product $cash): JsonResource
    {
        return new ProductResource($cash);
    }

    public function update(ProductRequest $request, Product $cash): JsonResource
    {
        $cash->update($request->all());

        return new ProductResource($cash);
    }

    public function destroy(Product $cash): JsonResource
    {
        $cash->delete();

        return new ProductResource($cash);
    }
}
