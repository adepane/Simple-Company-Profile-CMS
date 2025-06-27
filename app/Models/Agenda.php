<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'id',
        'title',
        'start',
        'end',
        'time_start',
        'time_end',
        'description',
        'color',
    ];

    protected $dates = [
        'start',
        'end',
    ];

    // public function getTimeStartAttribute($value)
    // {
    //     return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    //     // dd($value);
    // }

    // public function getTimeEndAttribute($value)
    // {
    //     return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    //     // dd($value);
    // }

    // public function getStartAttribute($value)
    // {
    //     return Carbon::parse($value)->format('Y-m-d');
    // }

    // public function getEndAttribute($value)
    // {
    //     return Carbon::parse($value)->format('Y-m-d');
    // }
}
