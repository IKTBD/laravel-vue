<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\api\auth\Auth2;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $result=Auth2::login($request->input('mail'),$request->input('password'));
        return response()->json($result);
    }


    public function logout(Request $request)
    {
        $result=Auth2::logout();
        return response()->json($result);
    }


    public function login_check(Request $request)
    {
        $result=Auth2::login_check();
        return response()->json($result);
    }


    public function registration(Request $request)
    {
        $status=false;
        $status_message='';
        $date=date('Y-m-d');
        $time=date('h:i:s a');
        $all_time=date('Y-m-d H:i:s');

        $first_name='';
        $last_name='';
        $email='';
        $password='';
        $confirm_password='';
        $sex='';
        $birthday='';

        if($request->input('first_name')!=null){$first_name=trim($request->input('first_name'));}
        if($request->input('last_name')!=null){$last_name=trim($request->input('last_name'));}
        if($request->input('email')!=null){$email=trim($request->input('email'));}
        if($request->input('password')!=null){$password=trim($request->input('password'));}
        if($request->input('confirm_password')!=null){$confirm_password=trim($request->input('confirm_password'));}
        if($request->input('sex')!=null){$sex=trim($request->input('sex'));}
        if($request->input('birthday')!=null){$birthday=trim($request->input('birthday'));}

        if($first_name==''){$status_message='First Name is empty';}
        else if($last_name==''){$status_message='Last Name is empty';}
        else if($email==''){$status_message='Email is empty';}
        else if(filter_var($email, FILTER_SANITIZE_EMAIL)!=$email){$status_message='Invalid Mail';}
        else if($password==''){$status_message='Password is empty';}
        else if($confirm_password==''){$status_message='Confirm Password is empty';}
        else if($password!=$confirm_password){$status_message='Password and Confirm Password are not matching';}
        else if(strlen($password)<6 or strlen($password)>20){$status_message='Your password will be within 6 to 20 digits';}
        else if($sex==''){$status_message='Sex is empty';}
        else if($birthday==''){$status_message='Your birthday is empty';}
        else
        {
            $new_password=Hash::make($password);

            $mail_check=User::where('email',$email)->first();
            if($mail_check==null)
            {
                $result=User::insert(['first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'password'=>$new_password,'sex'=>$sex,'birthday'=>$birthday,'created_at'=>$all_time,'updated_at'=>$all_time]);
                if($result==true)
                {
                    $status=true;
                    $status_message='Registration successfull';
                }
                else{$status_message='Try again';}
            }
            else{$status_message='The mail "'.$email.'" already used';}

        }

        $output=['Status'=>$status,'Message'=>$status_message];
        return response()->json($output);
    }
}
