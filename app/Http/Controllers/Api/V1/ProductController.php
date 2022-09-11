<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\IndexResource;
use App\Http\Resources\Product\ShowResource;
use App\Http\Resources\Seller\IndexResource as SellerIndexResource;
use App\Models\Product;

/**
 * @group Products
 *
 * APIs for managing Product Management
 */
class ProductController extends Controller
{
    /**
     * Get Product List.
     * @header Accept application/json
     * @responseFile status=200 scenario="Success" storage/responses/product/index.json
     */

    public function index()
    {
        $products = Product::query()
            ->with(['images'])
            ->paginate();

        return IndexResource::collection($products);
    }

    /**
     * Get a Single Product.
     * @urlParam product_id integer required The ID of the product. Example: 1
     * @header Accept application/json
     * @responseFile status=200 scenario="Success" storage/responses/product/show.json
     * @response status=404 scenario="Product not found"
     */
    public function show(Product $product)
    {
        $product = $product->load(['images', 'sellers']);

        return ShowResource::make($product);
    }

    /**
     * Get Seller Details For A Product.
     * @urlParam product_id integer required The ID of the product. Example: 1
     * @header Accept application/json
     * @responseFile status=200 scenario="Success" storage/responses/product/product_sellers.json
     * @response status=404 scenario="Product not found"
     */
    public function productSellers(Product $product)
    {
        $sellers = $product->sellers;

        return SellerIndexResource::collection($sellers);
    }
}
