<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $fillable = [
        'id',
        'title',
        'slug',
        'id_media',
        'layout_id',
    ];

    public function media(){
        return $this->belongsTo(Media::class,'id_media','id');
    }
}
