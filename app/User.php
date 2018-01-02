<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
	use Notifiable;
   	protected $table = 'User';
    public $fillable = ['name','cnic','gender','username','email','password','user_role','date_of_birth'];
    protected $hidden = [
        'password'
    ];
}

