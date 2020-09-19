<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class Gallery extends Model
{
    protected $fillable = [
        'id',
        'title',
    ];
    
    public function gallerymedias()
    {
        return $this->belongsToMany(Media::class,'gallery_media','gallery_id','media_id')->withPivot('photo_desc');
    }
}
