<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(ProductSeller::class)
            ->withTimestamps()
            ->withPivot(['stock', 'price']);
    }
}
