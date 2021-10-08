<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\api\auth\Auth2;
use App\Models\User;

class UserController extends Controller
{
    public function user()
    {
        $result=Auth2::user();
        return response()->json($result);
    }

    public function update(Request $request)
    {
        $user_id=Auth2::user()->id;
        $status=false;
        $status_message='';
        $date=date('Y-m-d');
        $time=date('h:i:s a');
        $all_time=date('Y-m-d H:i:s');

        $first_name='';
        $last_name='';
        $sex='';
        $birthday='';

        if($request->input('first_name')!=null){$first_name=trim($request->input('first_name'));}
        if($request->input('last_name')!=null){$last_name=trim($request->input('last_name'));}
        if($request->input('sex')!=null){$sex=trim($request->input('sex'));}
        if($request->input('birthday')!=null){$birthday=trim($request->input('birthday'));}

        if($first_name==''){$status_message='First Name is empty';}
        else if($last_name==''){$status_message='Last Name is empty';}
        else if($sex==''){$status_message='Sex is empty';}
        else if($birthday==''){$status_message='Your birthday is empty';}
        else
        {
            
            $result=User::where('id',$user_id)->update(['first_name'=>$first_name,'last_name'=>$last_name,'sex'=>$sex,'birthday'=>$birthday]);
            if($result==true)
            {
                $status=true;
                $status_message='Updated successfully';
            }
            else{$status_message='Try again';}
            

        }

        $output=['Status'=>$status,'Message'=>$status_message];
        return response()->json($output);
    }
}
