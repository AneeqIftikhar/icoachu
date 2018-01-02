<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Quiz_Time_Management extends Model
{
    protected $table = 'Quiz_Time_Management';
    public $fillable = ['quiz_id','student_id','start_time','end_time'];
    public static function getTimeLeft($quiz_id,$student_id)
    {
    	try
        {
                
              $time = DB::table('Quiz_Time_Management')->where('student_id', '=', $student_id)->where('quiz_id', '=', $quiz_id)->select('Quiz_Time_Management.*')->get();
              //$time=json_decode($time);
              $now = Carbon::now();
              $end=$time[0]->end_time;
              $start=$time[0]->start_time;
              $end=Carbon::parse($end);
              $start=Carbon::parse($start);
              if($end<=$now)
              {
                return '00:00:00';
              }
              else
              {
                $left=$now->diff($end)->format('%H:%I:%S');
                return $left;
              }
              
        }
        catch (Exception $e){
          return response()->fail($e->getMessage);
        }
    }
}
