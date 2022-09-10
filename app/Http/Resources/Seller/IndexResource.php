<?php

namespace App\Http\Resources\Seller;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'pivot' => $this->whenLoaded('pivot', function () {
                return [
                    'stock' => $this->pivot->stock,
                    'price' => number_format($this->pivot->price, 2)
                ];
            })
        ];
    }
}
