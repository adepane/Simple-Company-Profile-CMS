<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'id',
        'name',
        'slug',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'terms', 'id_terms', 'id_post');
    }
}
