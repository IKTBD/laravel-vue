<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Api_token;
use App\Models\App_key;
use App\Models\User;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       // return $next($request);
       $api_token='';
       $app_key='';
       $app_secret='';

       if($request->hasHeader('X-App-Key')){$app_key=$request->header('X-App-Key');}
       if($request->hasHeader('X-App-Secret')){$app_secret=$request->header('X-App-Secret');}
       if($request->hasHeader('X-Api-Token')){$api_token=$request->header('X-Api-Token');}

       if($api_token==''){return response()->json(['Status' =>false,'Message' =>'Token not found']);}
       else
       {
            $token=base64_decode(base64_decode(base64_decode($api_token)));
            $app_key_id=App_key::where('app_key',$app_key)->where('app_secret',$app_secret)->first()->id;
            $result=Api_token::where('app_key_id',$app_key_id)->where('token',$api_token)->first();
            if($result==null){return response()->json(['Status' =>false,'Message' =>'Invalid Token']);}
            else
            {
                session_id($token);
                session_start();
                $user_id='';
                if(isset($_SESSION['user_id']))
                {
                    $user_id=$_SESSION['user_id'];
                    if($user_id==$result->user_id)
                    {
                        $result=User::where('id',$user_id)->first();
                        if($result==null)
                        {
                            session_destroy();
                            return response()->json(['Status' =>false,'Message' =>'Need login to access']);
                        }
                        else{return $next($request);}
                    }
                    else
                    {
                        session_destroy();
                        return response()->json(['Status' =>false,'Message' =>'Need login to access']);
                    }

                }
                else{return response()->json(['Status' =>false,'Message' =>'Need login to access']);}    
            }
        }
    }
}
