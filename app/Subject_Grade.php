<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject_Grade extends Model
{
    protected $table = 'Subject_Grade';
    public $fillable = ['grade_id','subject_id'];
}
