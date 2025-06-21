<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = [
        'id',
        'name',
        'slug'
    ];

    public function getBeritaCats(){
        return $this->hasMany(Post::class,'category_id');
    }
}
