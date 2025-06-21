<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'id',
        'title',
        'id_media',
        'desc',
        'order',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'id_media', 'id');
    }
}
