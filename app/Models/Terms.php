<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    protected $table = 'terms';

    protected $fillable = [
        'id',
        'id_post',
        'id_terms',
    ];

    public function terms_post()
    {
        return $this->belongsTo(Tag::class, 'id_terms', 'id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
