<?php

namespace App\Model;

class Query extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'contact';

    protected $fillable = ['id', 'name', 'email', 'message'];

    public $incrementing = false;
}
