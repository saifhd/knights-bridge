<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\SellerProductResource;
use App\Models\ProductSeller;

class SellerProductController extends Controller
{
    public function __invoke($id)
    {
        $products = ProductSeller::query()
            ->with('product.images')
            ->where('seller_id', $id)
            ->paginate();

        return SellerProductResource::collection($products);
    }
}
