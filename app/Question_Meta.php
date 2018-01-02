<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_Meta extends Model
{
   	protected $table = 'Question_Meta';
    public $fillable = ['question_id','meta_key','meta_value'];
}
