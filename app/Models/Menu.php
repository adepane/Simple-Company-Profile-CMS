<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title', 
        'slug', 
        'order', 
        'parent_id',
        'layout_id'
    ];

}
