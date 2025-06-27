<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'id',
        'title',
        'tautan',
        'id_media',
        'position',
        'script',
        'status',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'id_media', 'id');
    }
}