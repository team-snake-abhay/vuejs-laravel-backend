<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordEmail;

class ForgotPasswordController extends Controller
{
    public function forgotPass(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user)
        {
            $pass = Str::random(8);
            $user->password = bcrypt($pass);
            $user->save();

            $mailData['email'] = $user->email;
            $mailData['name'] = $user->name;
            $mailData['password'] = $pass;
            Mail::to($user->email)->send(new ForgotPasswordEmail($mailData));

            return response()->json([
                'success'=>true,
                'message'=>'Email Sent successfully to registered email address'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'This is not a registered email address'
            ]);
        }
    }


    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user)
        {
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'success'=>true,
                'message'=>'Password changed successfully'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No loggedin user found'
            ]);
        }
    }
}
