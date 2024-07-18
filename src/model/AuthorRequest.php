<?php

namespace App\Model;

class AuthorRequest extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'socialmedia_link',
        'socialmedia_link',
        'interested_tech',
        'comments',
    ];

    protected $table = 'author';

    public $incrementing = false;
}
