<?php

namespace App\Model;

class Post extends \Illuminate\Database\Eloquent\Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'posts';

    public $incrementing = false;

    protected $fillable = ['id', 'title', 'cover_img', 'body', 'subject', 'users_id', 'views', 'comments', 'status', 'meta_desc', 'read_time'];

    public function users()
    {
        return $this->belongsTo(\App\Model\User::class);
    }

    public function reviews()
    {
        return $this->hasMany(\App\Model\Review::class);
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Model\Tag::class);
    }
}
