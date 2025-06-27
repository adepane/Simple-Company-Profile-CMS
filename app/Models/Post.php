<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'id',
        'title',
        'slug',
        'content',
        'author',
        'category_id',
        'media_id',
        'ket_photo',
        'yt_video',
        'status',
        'view',
        'publish_date',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'publish_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function authors()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
