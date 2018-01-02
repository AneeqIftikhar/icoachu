<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student_Quiz_Response_Temp;
class Student_Quiz_Response_TempController extends Controller
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

   
            /*$student_quiz_response_temp = Student_Quiz_Response_Temp::firstOrNew(['quiz_id' => $request->input('quiz_id')],['question_id' => $request->input('question_id')]);

            $student_quiz_response_temp->student_id = $request->input('student_id');
            $student_quiz_response_temp->quiz_id = $request->input('quiz_id');
            $student_quiz_response_temp->question_id = $request->input('question_id');
            $student_quiz_response_temp->response = $request->input('response');
            $student_quiz_response_temp->save();

            */

            $student_quiz_response_temp = Student_Quiz_Response_Temp::updateOrCreate(
                ['student_id' => $request->input('student_id'),'quiz_id' => $request->input('quiz_id'),'question_id' => $request->input('question_id')],
                ['response' => $response = $request->input('response')]

                );
            return response()->success('','response recorded');
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
}
