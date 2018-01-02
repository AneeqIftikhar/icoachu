<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'Quiz';
    public $fillable = ['duration','total_marks','teacher_id','subject_grade_id'];
}
