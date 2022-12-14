<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSeller extends Pivot
{
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
