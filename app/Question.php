<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
     protected $table = 'Question';
    public $fillable = ['subject_grade_id','chapter_id','topid_id','type'];
}
