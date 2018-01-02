<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function accessSessionData(Request $request){
      if($request->session()->has('key'))
         echo $request->session()->get('key');
      else
         echo 'No data in the session';
   }
   public function storeSessionData(Request $request){
      $request->session()->put('my_name','Virat Gandhi');
      
   }
   public function deleteSessionData(Request $request){
      $request->session()->forget('id');
      
   }
   public function login_set_session($email){
      $request->session()->put('pay',$email);
      
   }
}
