<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;
use App\Models\Pdf;

class Pengumuman extends Model
{
    protected $fillable = [
        'id',
        'judul',
        'slug',
        'content',
        'id_media',
        'id_pdf',
        'status',
    ];

    public function media(){
        return $this->belongsTo(Media::class,'id_media','id');
    }

    public function pdfmedia(){
        return $this->belongsTo(Pdf::class,'id_pdf','id');
    }
}
