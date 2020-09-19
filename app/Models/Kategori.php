<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Berita;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = [
        'id',
        'name',
        'slug'
    ];

    public function getBeritaCats(){
        return $this->hasMany(Berita::class,'id_kategori');
    }
}
