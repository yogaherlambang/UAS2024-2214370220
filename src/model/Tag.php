<?php
namespace App\Model;

class Tag extends \Illuminate\Database\Eloquent\Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'name',
         
    ];
    
    public function posts()
    {
        return $this->hasMany(\App\Model\Post::class);
    }
}