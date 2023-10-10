<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Models\Subscription;
use App\Models\SubscriptionUsage;
use App\Models\Story;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        // return response($request);
        if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password, 'status'=>1])){
            return response([
                'error'=>[
                    'message' => 'Invalid Login Credentials'
                ]
                ],403);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        $countDaily  = Story::where('user_id',Auth::user()->id)->where('created_at', Carbon::now()->format('Y-m-d'))->get()->count();

        // Monthly Count Validation
        $start          = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end            = Carbon::now()->endOfMonth()->format('Y-m-d');
        $countMonthly   = Story::where('user_id',Auth::user()->id)->whereBetween('created_at', [$start,$end])->get()->count();

        return response([
            'user' => Auth::user(),
            'story_count' => [
                'daily' => $countDaily,
                'monthly' => $countMonthly
            ],
            'access_token' => $accessToken
        ]);
    }

    public function userInfo()
    {
        $countDaily  = Story::where('user_id',Auth::user()->id)->where('created_at', Carbon::now()->format('Y-m-d'))->get()->count();

        // Monthly Count Validation
        $start          = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end            = Carbon::now()->endOfMonth()->format('Y-m-d');
        $countMonthly   = Story::where('user_id',Auth::user()->id)->whereBetween('created_at', [$start,$end])->get()->count();

        return response()->json([
            'success'=>true,
            'message'=>'User Information foud Successfully.',
            'data'=> [
                'user' => Auth::user(),
                'subscription_info' => Subscription::where('package_name', Auth::user()->subscription)->first(),
                'subscription_usage_today' => SubscriptionUsage::where('user_id',Auth::user()->id)->where('usage_date', date('Y-m-d'))->first(),
                'story_limit' => [
                    'daily' => $countDaily,
                    'monthly' => $countMonthly
                ]
            ]
        ]);
    }

    public function logout(Request $request) {
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        return response()->json([
            'success'=>true,
            'message'=>'Loggedout Successfully.'
        ]);
    }



}
