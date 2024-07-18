<?php
namespace App\Model;

class TagMap extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'post_tag';
    public $timestamps = false;
    protected $fillable = [
        'post_id',
        'tag_id',
       
    ];
}