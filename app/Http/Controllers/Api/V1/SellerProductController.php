<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\SellerProductResource;
use App\Models\ProductSeller;

/**
 * @group Sellers
 *
 * APIs for managing Sellers
 */
class SellerProductController extends Controller
{
    /**
     * Get Product List For Seller.
     * @urlParam id integer required The ID of the seller. Example: 1
     * @header Accept application/json
     * @responseFile status=200 scenario="Success" storage/responses/seller/products.json
     * @response status=404 scenario="Product not found"
     */
    public function __invoke($id)
    {
        $products = ProductSeller::query()
            ->with('product.images')
            ->where('seller_id', $id)
            ->paginate();

        return SellerProductResource::collection($products);
    }
}
