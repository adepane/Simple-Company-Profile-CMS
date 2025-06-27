<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'id',
        'title',
        'slug',
        'content',
        'media_id',
        'document_id',
        'status',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }
}