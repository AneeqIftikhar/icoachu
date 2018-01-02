<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz_Time_Management;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Quiz_Time_ManagementController extends Controller
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
            $time = new Quiz_Time_Management;
            $time->student_id = $request->input('student_id');
            $time->quiz_id = $request->input('quiz_id');
            $start = Carbon::now();
            $time->start_time = $start;
            
            $end = Carbon::now();

            //$end = $start;
            $end->addMinutes($request->input('quiz_duration'));
            $time->end_time = $end;


            $time->save();
            return response()->success('','Time Recorded');
        }
        catch (Exception $e){
          return response()->fail($e->getMessage);
        }
    }
    public function getTimeLeft(Request $request)
    {
        try
        {
                $stdId=$request->input('student_id');
                $quiz_id=$request->input('quiz_id');
                $left_time=Quiz_Time_Management::getTimeLeft($quiz_id,$stdId);

                return response()->success($left_time,'Time left');
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
