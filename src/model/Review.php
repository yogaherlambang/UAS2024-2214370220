<?php
namespace App\Model;

class Review extends  \Illuminate\Database\Eloquent\Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $table = "reviews";

    public $incrementing = false;

    protected $fillable = ['id', 'post_id', 'user_id', 'body'];

    public function post()
    {
        return $this->belongsTo(\App\Model\Post::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Model\User::class);
    }

}