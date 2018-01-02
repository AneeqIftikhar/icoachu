<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_Question extends Model
{
    protected $table = 'Quiz_Question';
    public $fillable = ['quiz_id','question_id','marks'];
}
