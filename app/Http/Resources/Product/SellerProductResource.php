<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->product_id,
            'description' => $this->whenLoaded('product', $this->product['description']),
            'stock' => $this->stock,
            'price' => $this->price,
            'images' => $this->whenLoaded('product', ImageResource::collection($this->product['images'])),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        
    }
}
