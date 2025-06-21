<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    protected $fillable = [
        'id',
        'judul',
        'slug',
        'content',
        'id_media',
        'ket_photo',
        'status',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'id_media', 'id');
    }
}
