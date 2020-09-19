<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Berita;
use App\Models\Tag;

class Terms extends Model
{
    protected $table = 'terms';
    protected $fillable = [
        'id',
        'id_post',
        'id_terms'
    ];

    public function terms_post(){
        return $this->belongsTo(Tag::class,'id_terms','id');
    }

    public function posts(){
        return $this->belongsToMany(Berita::class);
    }

}
