<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'email',
        'phone',
        'perihal',
        'isi',
        'status',
    ];
}
