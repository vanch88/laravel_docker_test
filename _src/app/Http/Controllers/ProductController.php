<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json([
            'status' => 'success',
            'data' => $products,
        ], Response::HTTP_OK);
    }

    /**
     * @param \App\Http\Requests\StoreProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        Log::info('Продукт создан', ['product_id' => $product->id, 'name' => $product->name]);

        return response()->json([
            'status' => 'success',
            'message' => 'Продукт успешно создан',
            'data' => $product,
        ], Response::HTTP_CREATED);
    }

    /**
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $product,
        ], Response::HTTP_OK);
    }

    /**
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        Log::info('Продукт обновлен', ['product_id' => $product->id, 'name' => $product->name]);

        return response()->json([
            'status' => 'success',
            'message' => 'Продукт успешно обновлен',
            'data' => $product->fresh(),
        ], Response::HTTP_OK);
    }

    /**
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $productId = $product->id;
        $productName = $product->name;

        $product->delete();

        Log::info('Продукт удален', ['product_id' => $productId, 'name' => $productName]);

        return response()->json([
            'status' => 'success',
            'message' => 'Продукт успешно удален',
        ], Response::HTTP_OK);
    }
}
