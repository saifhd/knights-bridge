<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'image_url',
        'imageable_type',
        'imageable_id'
    ];

    protected $appends = ['image_url'];

    public function imageable() : MorphTo
    {
        return $this->morphTo();
    }

    public function getImageUrlAttribute() : string
    {
        if($this->disk == 'local') {
            return Storage::disk($this->disk)->get($this->image_path);
        }

        return Storage::disk('public')->url('storage/'. $this->image_path);
    }
}
