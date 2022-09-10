<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Seller\IndexResource as SellerIndexResource;
use App\Http\Resources\Seller\IndexRsource;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'description' => $this->description,
            'images' => $this->whenLoaded('images', ImageResource::collection($this->images)),
        ];
    }
}
