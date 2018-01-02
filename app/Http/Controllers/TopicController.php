<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Topic;
use Auth;
use Session;
class TopicController extends Controller
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
            
            $topic = Topic::all();
            $message='Rows Returned: ';
            $message=$message.count($topic);
            //return response()->success($topic,$message);
            //response()->success($topic,Session::get('my_var'));
            return response()->success($topic,Session::get('my_name'));
             
      
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
        return response()->success($topic,Session::get('my_var'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic= Topic::find($id);
        return response()->json($topic);
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
    public function getAllTopicOfSubject($id)
    {
      
       $topic = DB::table('Topic')->join('Chapter', 'Topic.ChapterId', '=', 'Chapter.Id')
       ->where('SubjectId', '=', $id)->select('Topic.*')->get();
       return response()->json($topic);
    }
   
}
