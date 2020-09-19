<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    use SoftDeletes;
    protected $table = 'berita';
    protected $fillable = [
        'id',
        'judul',
        'slug',
        'content',
        'author',
        'id_kategori',
        'id_media',
        'status',
        'view',
        'publish_date',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'publish_date'
    ];

    public function kategories()
    {
        return $this->belongsTo(Kategori::class,'id_kategori','id');
    }

    public function authors()
    {
        return $this->belongsTo(User::class,'author','id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'terms','id_post','id_terms');
    }
    public function media(){
        return $this->belongsTo(Media::class,'id_media','id');
    }
}
