<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'Subject';
    public $fillable = ['name','description'];
}
