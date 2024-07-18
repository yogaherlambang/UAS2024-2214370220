<?php
namespace App\Model;

class PasswordRequest extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'password_reset_request';

    public $incrementing = false;

    protected $fillable = ['id', 'user_id', 'token', 'iv'];

    public function user()
    {
        return $this->belongsTo(\App\Model\User::class);
    }
}