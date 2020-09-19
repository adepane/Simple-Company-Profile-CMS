<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class Iklan extends Model
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

    public function media(){
        return $this->belongsTo(Media::class,'id_media','id');
    }

}
