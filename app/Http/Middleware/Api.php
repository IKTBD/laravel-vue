<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\App_key;

class Api
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
        //return $next($request);
        $app_key='';
        $app_secret='';

        if($request->hasHeader('X-App-Key')){$app_key=$request->header('X-App-Key');}
        if($request->hasHeader('X-App-Secret')){$app_secret=$request->header('X-App-Secret');}

        if($app_key==''){return response()->json(['Status' =>false,'Message' =>'App Key not found']);}
        else if($app_secret==''){return response()->json(['Status' =>false,'Message' =>'App secret not found']);}
        else
        {
            $result=App_key::where('app_key',$app_key)->where('app_secret',$app_secret)->first();
            if($result==null){return response()->json(['Status' =>false,'Message' =>'App key or App secret is wrong']);}
            else{
               if(\Request::is('api/login')==true){session_start();}
                return $next($request);}

        }


    }
}
