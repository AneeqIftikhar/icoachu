<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
class VerifyJWTToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
        public function handle($request, Closure $next)
        {
            try{
                $user = JWTAuth::toUser($request->bearerToken());
                if($request->route('student_id'))
                {
                    //return response()->json(['id'=>$user->id]);
                    if($request->route('student_id')!=$user->id)
                    {
                        return response()->json(['status'=>'token_error','message'=>'access_denied','data'=>[]]);
                    }
                }
                
            }catch (JWTException $e) {
                if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    return response()->json(['status'=>'token_error','message'=>'token_expired','data'=>[]]);
                }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return response()->json(['status'=>'token_error','message'=>'token_invalid','data'=>[]]);
                }else{
                    return response()->json(['status'=>'token_error','message'=>'token_required','data'=>[]]);
                }
            }
           return $next($request);
        }
}



   
    