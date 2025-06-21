<?php

namespace App\Models;

use App\Gallery;
use Illuminate\Database\Eloquent\Model;

class GalleryMedia extends Model
{
    protected $fillable = [
        'id',
        'gallery_id',
        'media_id',
        'photo_desc',
    ];

    public function galleries()
    {
        return $this->belongsToMany(Gallery::class);
    }
}
