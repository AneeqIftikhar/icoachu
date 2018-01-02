<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Question;
use App\Question_Meta;
use App\Sat_English;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try
        {

            $question = Question::all();
            $array=array();
            for ($i=0;$i<count($question);$i++)
            {
                //$question_meta=Question_Meta::find($question[0]->id);
                 $question_meta = DB::table('Question_Meta')->where('question_id', '=', $question[$i]->id)->select('Question_Meta.*')->get();
                //print_r(json_decode($question_meta, true));
                //cho $question[$i];

                $a=json_decode($question_meta, true);
                $b=json_decode($question[$i], true);
                $b["question_meta"]=$a;
                //array_push($b, $a);
                array_push($array,$b);
                
                
                
            }
            //print_r($array);
            //$question=json_encode($array,JSON_UNESCAPED_SLASHES);
            //$question=json_encode($array);
            $message='Rows Returned: ';
            $message=$message.count($question);
            return response()->success($array,$message);
      
        }
        catch (Exception $e){
          return response()->fail($e->getMessage);
        }
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


            $question = new Question;
            $question->subject_grade_id = $request->input('subject_grade_id');
            $question->chapter_id = $request->input('chapter_id');
            $question->topic_id = $request->input('topic_id');
            $question->type = $request->input('type');
            $question->status = $request->input('status');
            $question->teacher_id = $request->input('teacher_id');
            if ($request->has('Passage'))
            {
                $question->Passage = $request->input('Passage');
            }
            $question->save();

            if(strcmp($question->type,'mcq')==0)
            {
               
                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "description";
                $question_meta->meta_value = $request->input('description');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "a";
                $question_meta->meta_value = $request->input('a');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "b";
                $question_meta->meta_value = $request->input('b');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "c";
                $question_meta->meta_value = $request->input('c');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "d";
                $question_meta->meta_value = $request->input('d');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "answer";
                $question_meta->meta_value = $request->input('answer');
                $question_meta->save();
                if(strcmp($question->Passage,'1')==0)
                {
                    
                    $question_meta = new Question_Meta;
                    $question_meta->question_id =  $question->id;
                    $question_meta->meta_key = "passage_id";
                    $question_meta->meta_value = $request->input('passage_id');
                    $question_meta->save();
                }

            }
             else if(strcmp($question->type,'mcq_image')==0)
            {
                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "description";
                $question_meta->meta_value = $request->input('description');
                $question_meta->save();

               
                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "a";
                $question_meta->meta_value = $request->input('image_a');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "b";
                $question_meta->meta_value = $request->input('image_b');
                $question_meta->save();

               

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "c";
                $question_meta->meta_value = $request->input('image_c');
                $question_meta->save();

                

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "d";
                $question_meta->meta_value = $request->input('image_d');
                $question_meta->save();

               

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "answer";
                $question_meta->meta_value = $request->input('answer');
                $question_meta->save();
                  if(strcmp($question->Passage,'1')==0)
                {
                    
                    $question_meta = new Question_Meta;
                    $question_meta->question_id = $question->id;
                    $question_meta->meta_key = "passage_id";
                    $question_meta->meta_value = $request->input('passage_id');
                    $question_meta->save();
                }
            }
            else if(strcmp($question->type,'single_answer')==0)
            {
                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "description";
                $question_meta->meta_value = $request->input('description');
                $question_meta->save();
     

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "answer";
                $question_meta->meta_value = $request->input('answer');
                $question_meta->save();
                  if(strcmp($question->Passage,'1')==0)
                {
                   
                    $question_meta = new Question_Meta;
                    $question_meta->question_id = $question->id;
                    $question_meta->meta_key = "passage_id";
                    $question_meta->meta_value = $request->input('passage_id');
                    $question_meta->save();
                }

            }
            else if(strcmp($question->type,'image_single_answer')==0)
            {
                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "description";
                $question_meta->meta_value = $request->input('description');
                $question_meta->save();
                
                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "image";
                $question_meta->meta_value = $request->input('image');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "answer";
                $question_meta->meta_value = $request->input('answer');
                $question_meta->save();
                if(strcmp($question->Passage,'1')==0)
                {
                   
                    $question_meta = new Question_Meta;
                    $question_meta->question_id = $question->id;
                    $question_meta->meta_key = "passage_id";
                    $question_meta->meta_value = $request->input('passage_id');
                    $question_meta->save();
                }

            }
            else if(strcmp($question->type,'image_mcq')==0)
            {
                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "description";
                $question_meta->meta_value = $request->input('description');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "a";
                $question_meta->meta_value = $request->input('a');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "b";
                $question_meta->meta_value = $request->input('b');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "c";
                $question_meta->meta_value = $request->input('c');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "d";
                $question_meta->meta_value = $request->input('d');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "image";
                $question_meta->meta_value = $request->input('image');
                $question_meta->save();

                $question_meta = new Question_Meta;
                $question_meta->question_id = $question->id;
                $question_meta->meta_key = "answer";
                $question_meta->meta_value = $request->input('answer');
                $question_meta->save();
                if(strcmp($question->Passage,'1')==0)
                {
                   
                    $question_meta = new Question_Meta;
                    $question_meta->question_id = $question->id;
                    $question_meta->meta_key = "passage_id";
                    $question_meta->meta_value = $request->input('passage_id');
                    $question_meta->save();
                }
            }
            return response()->success('','question saved');
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
        

        try
        {

            $question = Question::find($id);
            $array=array();
                 $question_meta = DB::table('Question_Meta')->where('question_id', '=', $question->id)->select('Question_Meta.*')->get();
                
                $a=json_decode($question_meta, true);
                $b=json_decode($question, true);
                $b["question_meta"]=$a;
                array_push($array,$b);
              
            $message='Rows Returned: ';
            $message=$message.count($question);
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
        //Item::find($id)->update($request->all());

        try
        {


            $question = Question::find($id);
            $question->subject_grade_id = $request->input('subject_grade_id');
            $question->chapter_id = $request->input('chapter_id');
            $question->topic_id = $request->input('topic_id');
            $question->type = $request->input('type');
            $question->status = $request->input('status');
            $question->teacher_id = $request->input('teacher_id');
            if ($request->has('Passage'))
            {
                $question->Passage = $request->input('Passage');
            }
            $question->update();

            if(strcmp($question->type,'mcq')==0)
            {

                $question_meta_id = DB::table('Question_Meta')->where('question_id', '=', $question->id)->select('id')->get();

                for($i=0;$i<count($question_meta_id);$i++)
                {
                    $question_meta= Question_Meta::find($question_meta_id[$i]->id);
                    if($question_meta->meta_key == "description")
                    {
                        $question_meta->meta_value = $request->input('description');
                        
                    }
                    if($question_meta->meta_key == "a")
                    {
                        $question_meta->meta_value = $request->input('a');
                    }
                    if($question_meta->meta_key == "b")
                    {
                         $question_meta->meta_value = $request->input('b');
                    }
                    if($question_meta->meta_key == "c")
                    {
                         $question_meta->meta_value = $request->input('c');
                    }
                    if($question_meta->meta_key == "d")
                    {
                         $question_meta->meta_value = $request->input('d');
                    }
                    if($question_meta->meta_key == "answer")
                    {
                         $question_meta->meta_value = $request->input('answer');
                    }
                    if($question_meta->meta_key == "passage_id")
                    {
                         $question_meta->meta_value = $request->input('passage_id');
                    }
                    

                    $question_meta->update();

                }
               
                

            }
             else if(strcmp($question->type,'mcq_image')==0)
            {
                $question_meta_id = DB::table('Question_Meta')->where('question_id', '=', $question->id)->select('id')->get();

                for($i=0;$i<count($question_meta_id);$i++)
                {
                    $question_meta= Question_Meta::find($question_meta_id[$i]->id);
                    if($question_meta->meta_key == "description")
                    {
                        $question_meta->meta_value = $request->input('description');
                        
                    }
                    if($question_meta->meta_key == "a")
                    {
                        $question_meta->meta_value = $request->input('image_a');
                    }
                    if($question_meta->meta_key == "b")
                    {
                         $question_meta->meta_value = $request->input('image_b');
                    }
                    if($question_meta->meta_key == "c")
                    {
                         $question_meta->meta_value = $request->input('image_c');
                    }
                    if($question_meta->meta_key == "d")
                    {
                         $question_meta->meta_value = $request->input('image_d');
                    }
                    if($question_meta->meta_key == "answer")
                    {
                         $question_meta->meta_value = $request->input('answer');
                    }
                    if($question_meta->meta_key == "passage_id")
                    {
                         $question_meta->meta_value = $request->input('passage_id');
                    }
                    

                    $question_meta->update();

                }
                
            }
            else if(strcmp($question->type,'single_answer')==0)
            {
               $question_meta_id = DB::table('Question_Meta')->where('question_id', '=', $question->id)->select('id')->get();

                for($i=0;$i<count($question_meta_id);$i++)
                {
                    $question_meta= Question_Meta::find($question_meta_id[$i]->id);
                    if($question_meta->meta_key == "description")
                    {
                        $question_meta->meta_value = $request->input('description');
                        
                    }
                    if($question_meta->meta_key == "answer")
                    {
                         $question_meta->meta_value = $request->input('answer');
                    }
                    if($question_meta->meta_key == "passage_id")
                    {
                         $question_meta->meta_value = $request->input('passage_id');
                    }
                    

                    $question_meta->update();

                }

            }
            else if(strcmp($question->type,'image_single_answer')==0)
            {
                $question_meta_id = DB::table('Question_Meta')->where('question_id', '=', $question->id)->select('id')->get();

                for($i=0;$i<count($question_meta_id);$i++)
                {
                    $question_meta= Question_Meta::find($question_meta_id[$i]->id);
                    if($question_meta->meta_key == "description")
                    {
                        $question_meta->meta_value = $request->input('description');
                        
                    }
                    if($question_meta->meta_key == "image")
                    {
                        $question_meta->meta_value = $request->input('image');
                    }
                    
                    if($question_meta->meta_key == "answer")
                    {
                         $question_meta->meta_value = $request->input('answer');
                    }
                    if($question_meta->meta_key == "passage_id")
                    {
                         $question_meta->meta_value = $request->input('passage_id');
                    }
                    

                    $question_meta->update();

                }

            }
            else if(strcmp($question->type,'image_mcq')==0)
            {
                $question_meta_id = DB::table('Question_Meta')->where('question_id', '=', $question->id)->select('id')->get();

                for($i=0;$i<count($question_meta_id);$i++)
                {
                    $question_meta= Question_Meta::find($question_meta_id[$i]->id);
                    if($question_meta->meta_key == "description")
                    {
                        $question_meta->meta_value = $request->input('description');
                        
                    }
                    if($question_meta->meta_key == "a")
                    {
                        $question_meta->meta_value = $request->input('a');
                    }
                    if($question_meta->meta_key == "b")
                    {
                         $question_meta->meta_value = $request->input('b');
                    }
                    if($question_meta->meta_key == "c")
                    {
                         $question_meta->meta_value = $request->input('c');
                    }
                    if($question_meta->meta_key == "d")
                    {
                         $question_meta->meta_value = $request->input('d');
                    }
                    if($question_meta->meta_key == "image")
                    {
                         $question_meta->meta_value = $request->input('image');
                    }
                    if($question_meta->meta_key == "answer")
                    {
                         $question_meta->meta_value = $request->input('answer');
                    }
                    if($question_meta->meta_key == "passage_id")
                    {
                         $question_meta->meta_value = $request->input('passage_id');
                    }
                    

                    $question_meta->update();

                }
            }
            return response()->success('','question saved');
       }
        catch (Exception $e){
          return response()->fail($e->getMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            Question_Meta::where('question_id', $id)->delete();
            Question::where('id', $id)->delete();
            DB::commit();
            return response()->success('','question deleted successfully');
        } catch (Exception $e) {
            DB::rollback();

           
        }
        
    }
    public function getAllQuestionOfSubject($id)
    {
      

        try
        {

             $question = DB::table('Question')->where('subject_id', '=', $id)->select('Question.*')->get();
            $array=array();
            for ($i=0;$i<count($question);$i++)
            {
                //$question_meta=Question_Meta::find($question[0]->id);
                 $question_meta = DB::table('Question_Meta')->where('question_id', '=', $question[$i]->id)->select('Question_Meta.*')->get();
                //print_r(json_decode($question_meta, true));
                //echo $question_meta;
                $a=json_decode($question_meta, true);
                $b=json_decode($question[$i], true);
                $b["question_meta"]=$a;
                //array_push($b, $a);
                array_push($array,$b);
                
                
                
            }
            //print_r($array);
            //$question=json_encode($array,JSON_UNESCAPED_SLASHES);
            //$question=json_encode($array);
            $message='Rows Returned: ';
            $message=$message.count($question);
            return response()->success($array,$message);
      
        }
        catch (Exception $e){
          return response()->fail($e->getMessage);
        }
    }
    public function getAllQuestionOfTopic($id)
    {
      
       $question = DB::table('Question')->where('topic_id', '=', $id)->select('Question.*')->get();
       return response()->json($question);
    }
     public function getAllQuestionOfChapter($id)
    {
      
       $question = DB::table('Question')->where('chapter_id', '=', $id)->select('Question.*')->get();
       return response()->json($question);
    }
    
}
