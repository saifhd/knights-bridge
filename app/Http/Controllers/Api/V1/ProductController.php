<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\IndexResource;
use App\Http\Resources\Product\ShowResource;
use App\Http\Resources\Seller\IndexResource as SellerIndexResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with(['images'])
            ->paginate();

        return IndexResource::collection($products);
    }

    public function show(Product $product)
    {
        $product = $product->load(['images', 'sellers']);

        return ShowResource::make($product);
    }

    public function productSellers(Product $product)
    {
        $sellers = $product->sellers;

        return SellerIndexResource::collection($sellers);
    }
}
