<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'Chapter';
    public $fillable = ['name','subject_grade_id'];
}
