<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student_Quiz_Response;
use App\Question;
use Illuminate\Support\Facades\DB;
class Student_Quiz_ResponseController extends Controller
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
            /*$student_quiz_response = new Student_Quiz_Response;
            $student_quiz_response->student_id = $request->input('student_id');
            $student_quiz_response->quiz_id = $request->input('quiz_id');
            $student_quiz_response->question_id = $request->input('question_id');
            $student_quiz_response->response = $request->input('response');
            $student_quiz_response->save();*/
             $student_quiz_response = Student_Quiz_Response::updateOrCreate(
                ['student_id' => $request->input('student_id'),'quiz_id' => $request->input('quiz_id'),'question_id' => $request->input('question_id')],
                ['response' => $response = $request->input('response')]

                );

            $responses = DB::table('Student_Quiz_Response')->where('student_id', '=',$request->input('student_id'))->where('quiz_id', '=', $request->input('quiz_id'))->select('question_id','response')->get();

            return response()->success(json_decode($responses,true),'response recorded');
        }
        catch (Exception $e){
          return response()->fail($e->getMessage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function total_correct($responses)
    {
         
        $correct=0;
        for($i=0;$i<count($responses);$i++)
        {
           if($responses[$i]->type=="single_answer")
           {
                $res=0; $ans=0;
                if(strpos($responses[$i]->response,"/")!==false)
                {
                     $fraction=$responses[$i]->response;
                     $numbers=explode("/",$fraction);
                     $res=round($numbers[0]/$numbers[1],2);

                     if(strpos($responses[$i]->answer,"/")!==false)
                     {
                         $fraction=$responses[$i]->answer;
                         $numbers=explode("/",$fraction);
                         $ans=round($numbers[0]/$numbers[1],2);
                         if($res==$ans)
                         {
                            $correct++;
                         }
                     }
                     else
                     {
                        $num=number_format((float)$responses[$i]->answer, 2, '.', '');
                        $ans=round($num,2);
                        if($res==$ans)
                         {
                            $correct++;
                         }
                     }
                }
                else
                {
                    if(strpos($responses[$i]->answer,"/")!==false)
                     {
                         $fraction=$responses[$i]->answer;
                         $numbers=explode("/",$fraction);
                         $ans=round($numbers[0]/$numbers[1],2);
                         $res=round($responses[$i]->response,2);
                         if($res==$ans)
                         {
                            $correct++;
                         }
                     }
                     else
                     {
                        $ans=round($responses[$i]->answer,2);
                         $res=round($responses[$i]->response,2);
                        if($res==$ans)
                         {
                            $correct++;
                         }
                     }
                }
           }
           else
           {
                    if($responses[$i]->type=="mcq" || $responses[$i]->type=="image_mcq")
                    {
                         if(strpos($responses[$i]->answer, $responses[$i]->response)!==false)
                        {
                            $correct++;
                        }
                    }
                    else
                    {
                        $num=number_format((float)$responses[$i]->answer, 2, '.', '');
                        $ans=round($num,2);
                        $num=number_format((float)$responses[$i]->response, 2, '.', '');
                        $res=round($num,2);
                        if($res==$ans)
                        {
                                    $correct++;
                        }
                    }
           }
            
        }
        return $correct;
    }
    public function check_answer($responses)
    {
         


         if(count($responses)!=0)
         {
             $i=0;
             $correct=0;
             if($responses[$i]->type=="single_answer")
               {
                    $res=0; $ans=0;
                    if(strpos($responses[$i]->response,"/")!==false)
                    {
                         $fraction=$responses[$i]->response;
                         $numbers=explode("/",$fraction);
                         $res=round($numbers[0]/$numbers[1],2);

                         if(strpos($responses[$i]->answer,"/")!==false)
                         {
                             $fraction=$responses[$i]->answer;
                             $numbers=explode("/",$fraction);
                             $ans=round($numbers[0]/$numbers[1],2);
                             if($res==$ans)
                             {
                                $correct++;
                             }
                         }
                         else
                         {
                            $num=number_format((float)$responses[$i]->answer, 2, '.', '');
                            $ans=round($num,2);
                            if($res==$ans)
                             {
                                $correct++;
                             }
                         }
                    }
                    else
                    {
                        if(strpos($responses[$i]->answer,"/")!==false)
                         {
                             $fraction=$responses[$i]->answer;
                             $numbers=explode("/",$fraction);
                             $ans=round($numbers[0]/$numbers[1],2);
                             $res=round($responses[$i]->response,2);
                             if($res==$ans)
                             {
                                $correct++;
                             }
                         }
                         else
                         {
                            $ans=round($responses[$i]->answer,2);
                             $res=round($responses[$i]->response,2);
                            if($res==$ans)
                             {
                                $correct++;
                             }
                         }
                    }
               }
               else
               {
                    if($responses[$i]->type=="mcq" || $responses[$i]->type=="image_mcq")
                    {
                        if(strpos($responses[$i]->answer, $responses[$i]->response)!==false)
                        {
                            $correct++;
                        }
                    }
                    else
                    {
                        $num=number_format((float)$responses[$i]->answer, 2, '.', '');
                        $ans=round($num,2);
                        $num=number_format((float)$responses[$i]->response, 2, '.', '');
                        $res=round($num,2);
                        if($res==$ans)
                        {
                                    $correct++;
                        }
                    }
                    
               }
               if($correct==1)
               {
                        return json_encode([
                      'message'=> 'correct',
                      'data' => $responses[0]->response,
                      ]);
                
               }
               else
               {
                  return json_encode([
                      'message'=> 'incorrect',
                      'data' => $responses[0]->response,
                      ]);
                
               }
         }
         else
         {
            return json_encode([
                      'message'=> 'unanswered',
                      'data' => '',
                      ]);
         }
         
        

         
    }
    public function compute_result($quiz_id,$student_id)
    {
        

        //echo $responses;
            $response = DB::table('Student_Quiz_Response')->where('student_id', '=',$student_id)->where('quiz_id', '=',$quiz_id)->get();
          
            if(count($response)>0)
            {
                  try
                  {
       
                     $responses = DB::table('Student_Quiz_Response as r')->join('Question as q', 'r.question_id', '=', 'q.id')->join('Question_Meta as m', 'm.question_id', '=', 'r.question_id')->where('m.meta_key', '=','answer')->where('r.student_id', '=',$student_id)->where('r.quiz_id', '=', $quiz_id)->select('r.question_id','q.type','r.response','m.meta_value as answer')->get();

                   
                    
                     $temp_correct=0;
                     $temp_incorrect=0;
                     $temp_unanswered=0;
                     $array=array();
                     
                     
                     
                     $quiz_question = DB::table('Quiz_Question as q')->where('q.quiz_id', '=', $quiz_id)->get();
                     $total=count($quiz_question);
                     for($i=0;$i<$total;$i++)
                     {
                        $question = Question::find($quiz_question[$i]->question_id);
                        
                             $question_meta = DB::table('Question_Meta')->where('question_id', '=', $question->id)->select('Question_Meta.*')->get();
                            
                            $a=json_decode($question_meta, true);
                            $b=json_decode($question, true);
                            $b["question_meta"]=$a;

                            $responses = DB::table('Student_Quiz_Response as r')->join('Question as q', 'r.question_id', '=', 'q.id')->join('Question_Meta as m', 'm.question_id', '=', 'r.question_id')->where('m.meta_key', '=','answer')->where('r.student_id', '=',$student_id)->where('r.quiz_id', '=', $quiz_id)->where('r.question_id', '=', $question->id)->select('r.question_id','q.type','r.response','m.meta_value as answer')->get();

                            $check_response=json_decode($this->check_answer($responses));
                            $b["result"]=$check_response->message;
                            if($check_response->message=='correct')
                            {
                                $temp_correct++;
                            }
                            else if($check_response->message=='incorrect')
                            {
                                $temp_incorrect++;
                            }
                            else if($check_response->message=='unanswered')
                            {
                                $temp_unanswered++;
                            }
                            $b["response"]=$check_response->data;
                            array_push($array,$b);
                          
                        
                     }
                       $array_quiz_info['total']=$total;
                       $array_quiz_info['correct']=$temp_correct;
                       $array_quiz_info['incorrect']=$temp_incorrect;
                       $array_quiz_info['unanswered']=$temp_unanswered;
                       $array_quiz_info['question_wise_result']=$array;
                      
                        $message='Rows Returned: ';
                        $message=$message.count($question);
                        return response()->success($array_quiz_info,$message);
                  
                    }
                catch (Exception $e){
                  return response()->fail($e->getMessage);
                }

            }
            else
            {
                return response()->fail("No such quiz have been attempted by this user");
            }
           
        
         
          

  

    }


     public function generate_report($student_id,$subject_grade_id)
    {
        

        $topics=DB::table('Subject_Grade as s')->join('Chapter as c', 's.id', '=', 'c.subject_grade_id')->join('Topic as t', 't.chapter_id', '=', 'c.id')->where('s.id', '=',$subject_grade_id)->select('t.id','t.name')->get();

       
        
        $array2=array();
        for($i=0;$i<count($topics);$i++)
        {
            $student_response = DB::table('Student_Quiz_Response as r')->join('Question as q', 'r.question_id', '=', 'q.id')->join('Question_Meta as m', 'm.question_id', '=', 'r.question_id')->where('m.meta_key', '=','answer')->where('r.student_id', '=',$student_id)->where('q.subject_grade_id', '=',$subject_grade_id)->where('q.topic_id', '=',$topics[$i]->id)->select('r.question_id','q.type','r.response','m.meta_value as answer')->get();


            $correct=$this->total_correct($student_response);
                 
            $topush=array();
             $array_quiz_info['topic_id']=$topics[$i]->id;
             $array_quiz_info['topic_name']=$topics[$i]->name;
             $array_quiz_info['correct']=$correct;
             $array_quiz_info['total']=count($student_response);
             if(count($student_response)>0)
             {
                $array_quiz_info['percent_correct']=(round($correct/count($student_response),2)*100);
             }
             else
             {
                $array_quiz_info['percent_correct']=100;
             }
             $topush['topic_info']=$array_quiz_info;
             
             
             for($j=0;$j<count($student_response);$j++)
             {
                $question = Question::find($student_response[$j]->question_id);
                
                     $question_meta = DB::table('Question_Meta')->where('question_id', '=', $question->id)->select('Question_Meta.*')->get();
                    
                    $a=json_decode($question_meta, true);
                    $b=json_decode($question, true);
                    $b["question_meta"]=$a;

                    $responses = DB::table('Student_Quiz_Response as r')->join('Question as q', 'r.question_id', '=', 'q.id')->join('Question_Meta as m', 'm.question_id', '=', 'r.question_id')->where('m.meta_key', '=','answer')->where('r.student_id', '=',$student_id)->where('r.question_id', '=', $question->id )->select('r.question_id','q.type','r.response','m.meta_value as answer')->get();

                    $check_response=json_decode($this->check_answer($responses));
                    $b["result"]=$check_response->message;
                    $b["response"]=$check_response->data;
                    array_push($topush,$b);
                  
                
             }
            array_push($array2,$topush);
               

            

        }
         $message='Rows Returned: ';
                //$message=$message.count($question);
                return response()->success($array2,$message);
    }

   

}