<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use App\Models\Api_token;
use App\Models\App_key;
use App\Models\User;

class Auth2 extends Controller
{
    static function login($mail,$password)
    {
        $request=Request();
        $status=false;
        $status_message='';
        $token='';

        $date=date('Y-m-d');
        $time=date('h:i:s a');
        $all_time=date('Y-m-d H:i:s');
        $timestamp=time();
        $limit=(60*60);

        if($mail==''){$status_message='Mail is empty';}
        else if($password==''){$status_message='Password is empty';}
        else
        {
            $result=User::where('email',$mail)->first();
            if($result==null){$status_message='Mail is wrong';}
            else
            {
                $old_password=$result->password;
                $password_check=Hash::check($password,$old_password);
                if($password_check==true)
                {
                    $app_key='';
                    $app_secret='';
                    if($request->hasHeader('X-App-Key')){$app_key=$request->header('X-App-Key');}
                    if($request->hasHeader('X-App-Secret')){$app_secret=$request->header('X-App-Secret');}
                    $app_key_id=App_key::where('app_key',$app_key)->where('app_secret',$app_secret)->first()->id;
                    $user_id=$result->id;
                    $session_id=session_id();
                    $token=base64_encode(base64_encode(base64_encode($session_id)));
                    $_SESSION['user_id']=$user_id;
                    $_SESSION['user_login']=true;

                    $result=Api_token::where('user_id',$user_id)->where('app_key_id',$app_key_id)->first();
                    if($result==null)
                    {
                        Api_token::insert(['user_id'=>$user_id,'app_key_id'=>$app_key_id,'token'=>$token,'expire_time'=>$limit,'date'=>$date,'time'=>$time,'timestamp'=>$timestamp,'created_at'=>$all_time,'updated_at'=>$all_time]);
                    }
                    else
                    {Api_token::where('id',$result->id)->update(['token'=>$token]);}

                    $status=true;
                    $status_message='Login success';
                }
                else{$status_message='Password is wrong';}
            }

        }
    
        if($status==false){$output=['Status'=>$status,'Message'=>$status_message];}
        else{$output=['Status'=>$status,'Message'=>$status_message,'token'=>$token];}
        return $output;
    }


    static function logout()
    {
        $status=false;
        $status_message='';
        $user_id='';
        if(isset($_SESSION['user_id'])){$user_id=$_SESSION['user_id'];}

        if($user_id==''){$status_message='Error try again';}
        else
        {
            $result=Api_token::where('user_id',$user_id)->delete();
            if($result==null){$status_message='Error try again';}
            else
            {
                session_destroy();
                $status=true;
                $status_message='Logout successfully';
            }
        }
    
        $output=['Status'=>$status,'Message'=>$status_message];
        return $output;
    }


    static function login_check()
    {
        $status=false;
        $status_message='Not login';
        if(isset($_SESSION['user_id']))
        {
           if($_SESSION['user_id']!='')
           {
               $status=true;
               $status_message='Login';
           } 
        }

        $output=['Status'=>$status,'Message'=>$status_message];
        return $output;
    }


    static function user()
    {
        $status=false;
        $status_message='';
        $user_id='';
        $result=[];
        if(isset($_SESSION['user_id'])){$user_id=$_SESSION['user_id'];}
        $result=User::where('id',$user_id)->first();
        if($result==null){$result=[];}
        return $result;
    }
}
