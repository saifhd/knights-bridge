<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Seller\IndexResource as SellerIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
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
            'id' => $this->id,
            'description' => $this->description,
            'images' => $this->whenLoaded('images', ImageResource::collection($this->images)),
            'sellers' => $this->whenLoaded('sellers', SellerIndexResource::collection(($this->sellers)))
        ];
    }
}
