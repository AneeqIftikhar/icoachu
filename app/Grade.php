<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
	protected $table = 'Grade';
    public $fillable = ['grade'];
}
