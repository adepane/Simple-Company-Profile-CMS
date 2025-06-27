<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'id',
        'title',
        'media_id',
        'desc',
        'order',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
