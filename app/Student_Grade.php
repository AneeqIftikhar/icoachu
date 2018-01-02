<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Grade extends Model
{
     protected $table = 'Student_Grade';
    public $fillable = ['grade_id','student_id'];
}
