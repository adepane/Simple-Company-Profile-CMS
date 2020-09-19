<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Gallery;

class GalleryMedia extends Model
{
    protected $fillable = [
        'id',
        'gallery_id',
        'media_id',
        'photo_desc',
    ];
    
    public function galleries(){
        return $this->belongsToMany(Gallery::class);
    }
}
