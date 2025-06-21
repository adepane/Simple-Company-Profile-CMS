<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function menulayout()
    {
        return $this->hasMany(Menu::class);
    }
}
