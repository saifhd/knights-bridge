<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'description'
    ];

    public function sellers() : BelongsToMany
    {
        return $this->belongsToMany(Seller::class)
            ->using(ProductSeller::class)
            ->withTimestamps()
            ->withPivot('stock', 'price');
    }

    public function images() : MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
