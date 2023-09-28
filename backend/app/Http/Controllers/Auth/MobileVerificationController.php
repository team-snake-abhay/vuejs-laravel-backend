<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Helpers\OtpGenerator;
use App\Services\TextMessage\DefaultProvider;

class MobileVerificationController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();       
        $request->validate([
            'otp'    => 'required|exists:users,otp',
        ]);
        
        if($user->otp == $request->otp){
            $user->mobile_varified_at = Carbon::now();
            $user->otp = 'U'.$request->otp;
            $user->save();

            return redirect()->intended(Auth::user()->url);
        }
            
        return redirect()->intended(route('pub.login.signup'));
       
        
    }

    /**
     * Send OTP by email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function sendOtp()
    {
        $user = Auth::user();

        $user->otp = OtpGenerator::generateNumericOTP(4);
        $user->save();
        $sms = new DefaultProvider();
        $sms->sendOtp($user->mobile,$user->otp);
       
        return redirect()->intended(route('pub.login.signup'));
    }

    
}