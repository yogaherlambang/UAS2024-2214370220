<?php
namespace App\Model;

class User extends  \Illuminate\Database\Eloquent\Model
{
    protected $table = "users";

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'username',
        'role',
        'password', 
        'is_active',
        'avatar', 
        'work', 
        'facebook', 
        'linkedin', 
        'twitter',
        'github',
        'website',
        'email',
        'about',
    ];

    public function posts()
    {
        return $this->hasMany(\App\Model\Post::class);
    }

    public function reviwe()
    {
        return $this->hasMany(\App\Model\Review::class);
    }

    public function passwordResetRequest()
    {
        return $this->hasMany(\App\Model\PasswordRequest::class);
    }

}