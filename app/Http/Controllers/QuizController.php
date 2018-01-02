<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Quiz;
use App\Quiz_Question;
use App\Question_Meta;
use App\Quiz_Time_Management;
use Carbon\Carbon;
class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
         try
        {
            $quiz = new Quiz;
            $quiz->duration = $request->input('duration');
            $quiz->total_marks = $request->input('total_marks');
            $quiz->teacher_id = $request->input('teacher_id');
            $quiz->subject_grade_id = $request->input('subject_grade_id');
            $quiz->save();

            $question_id=explode(",", $request->input('question'));
            $marks=explode(",", $request->input('marks'));

            for($i=0;$i<count($question_id);$i++)
            {
                $quiz_question = new Quiz_Question;
                $quiz_question->quiz_id = $quiz->id;
                $quiz_question->question_id = $question_id[$i];
                $quiz_question->marks = $marks[$i];
                $quiz_question->save();
            }
            return response()->success('','quiz saved');
        }
        catch (Exception $e){
          return response()->fail($e->getMessage);
        }
        

       
    }

    /**
     * Display the specified resource.
     *$id is quiz_id
     *$id2 is student_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$id2)
    {
        try
        {
           
            //if quiz has already started this will return the remaining time subracting from the start 
            //time.
            
            $array=array();
            if (Quiz_Time_Management::where('quiz_id', '=', $id)->where('student_id','=',$id2)->count() > 0) 
            {
                
                $quiz = DB::table('Quiz')->where('id', '=', $id)->select('Quiz.*')->get();
                $temp=json_decode($quiz);

                $time = DB::table('Quiz_Time_Management')->where('student_id', '=',$id2)->where('quiz_id', '=', $id)->select('Quiz_Time_Management.*')->get();
               
               $now = Carbon::now();
               $start=$time[0]->start_time;
               $start=Carbon::parse($start);
               $passed=$now->diffInMinutes($start);
               if($passed<$quiz[0]->duration)
               {
                    $quiz[0]->time_left=$quiz[0]->duration-$passed;
               }
               else
               {
                    $quiz[0]->time_left=0;
               }
                array_push($array,$quiz);
            }
            else//if quiz is starting for the first time then it will make an entry in quiz_time_management
            {

                
                $quiz = DB::table('Quiz')->where('id', '=', $id)->select('Quiz.*')->get();//getting quiz details
                $temp=json_decode($quiz);//temp variable to put checks if english quiz
                //entering data in time mamangement table
                $time = new Quiz_Time_Management;
                $time->student_id = $id2;
                $time->quiz_id = $id;
                $start = Carbon::now();
                $time->start_time = $start;
                $end = Carbon::now();
                $end->addMinutes($quiz[0]->duration);
                $time->end_time = $end;
                $time->save();
                $quiz[0]->time_left=$quiz[0]->duration;//setting time left
                array_push($array,$quiz);
            }
            //if sat english 
            if($temp[0]->subject_grade_id==1 || $temp[0]->subject_grade_id==2)
            {
                $quiz_question = DB::table('Quiz_Question')->where('quiz_id', '=', $id)->select('Quiz_Question.*')->get();
                
               
                for ($i=0;$i<count($quiz_question);$i++)
                {
                    //$question_meta=Question_Meta::find($question[0]->id);
                     $question = DB::table('Question')->where('id', '=', $quiz_question[$i]->question_id)->select('Question.*')->get();

                     $question_meta = DB::table('Question_Meta')->where('question_id', '=', $quiz_question[$i]->question_id)->where('meta_key','!=','answer')->select('Question_Meta.*')->get();

                    $passage_id='';
                     for($j=0;$j<count($question_meta);$j++)
                     {
                        if(strcmp($question_meta[$j]->meta_key,"passage"))
                        {
                            $passage_id=$question_meta[$j]->meta_value;
                        }
                     }
                     $passage_description = DB::table('Sat_English')->where('id', '=', $passage_id)->select('description')->get();
                    //print_r(json_decode($question_meta, true));
                    
                    $a=json_decode($question_meta, true);
                    $b=$quiz_question[$i];
                    $b->question_detail=$question;
                    $b->question_meta=$a;
                    $b->passage=$passage_description;
                    //array_push($b, $a);
                    array_push($array,$b);
                    
                    
                    
                } 
            }
            else //if the quiz is of other type
            {
               
                $quiz_question = DB::table('Quiz_Question')->where('quiz_id', '=', $id)->select('Quiz_Question.*')->get();
                
               
                for ($i=0;$i<count($quiz_question);$i++)
                {
                    //$question_meta=Question_Meta::find($question[0]->id);
                    $question = DB::table('Question')->where('id', '=', $quiz_question[$i]->question_id)->select('Question.*')->get();

                    $question_meta = DB::table('Question_Meta')->where('question_id', '=', $quiz_question[$i]->question_id)->where('meta_key','!=','answer')->select('Question_Meta.*')->get();

                    $a=json_decode($question_meta, true);
                    $b=$quiz_question[$i];
                    $b->question_detail=$question;
                    $b->question_meta=$a;
                    //array_push($b, $a);
                    array_push($array,$b);
                 } 
            }
            $message='Rows Returned: ';
            $message=$message.count($quiz_question);
            return response()->success($array,$message);
      
        }
        catch (Exception $e){
          return response()->fail($e->getMessage);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
