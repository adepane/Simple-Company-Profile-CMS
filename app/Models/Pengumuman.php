<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = [
        'id',
        'judul',
        'slug',
        'content',
        'id_media',
        'document_id',
        'status',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'id_media', 'id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }
}
