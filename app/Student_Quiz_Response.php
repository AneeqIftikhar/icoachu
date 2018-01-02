<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Quiz_Response extends Model
{
    protected $table = 'Student_Quiz_Response';
    public $fillable = ['student_id','quiz_id','question_id','response'];
}
