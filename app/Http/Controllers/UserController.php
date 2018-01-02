<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Session;
use JWTAuth;
use JWTAuthException;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
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
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;

        if (User::where('email', '=', $request->get('email'))->count() > 0) {


            try {
               if (!$token = JWTAuth::attempt($credentials)) {

                return response()->json(['status'=>'failed','message'=>'Incorrect email or Password','data'=>'']);
               }
            } catch (JWTAuthException $e) {

               return response()->json(['status'=>'failed','message'=>'Failed to create token','data'=>'']);
            }

            return response()->json(['status'=>'success','message'=>'User logged in successfully','data'=>JWTAuth::toUser($token),'token'=>$token]);


            
        }
        else
        {
             $user = User::create([
              'name' => $request->get('name'),
              'cnic' => $request->get('cnic'),
              'gender' => $request->get('gender'),
              'username'=> $request->get('username'),
              'email' => $request->get('email'),
              'password' => bcrypt($request->get('password')),
              'user_role' => $request->get('user_role'),
              'date_of_birth' => $request->get('dob')

            ]);
            try {
               if (!$token = JWTAuth::attempt($credentials)) {

                return response()->json(['status'=>'failed','message'=>'Incorrect email or Password','data'=>'']);
               }
            } catch (JWTAuthException $e) {

               return response()->json(['status'=>'failed','message'=>'Failed to create token','data'=>'']);
            }

            return response()->json(['status'=>'success','message'=>'User logged in successfully','data'=>'','token'=>$token]);
        }

    }
   
    public function register(Request $request)
    {



        $user = User::create([
          'name' => $request->get('name'),
          'cnic' => $request->get('cnic'),
          'gender' => $request->get('gender'),
          'username'=> $request->get('username'),
          'email' => $request->get('email'),
          'password' => bcrypt($request->get('password')),
          'user_role' => $request->get('user_role'),
          'date_of_birth' => $request->get('dob')

        ]);
        return response()->json(['status'=>'success','message'=>'User created successfully','data'=>$user]);
    }
  
}
