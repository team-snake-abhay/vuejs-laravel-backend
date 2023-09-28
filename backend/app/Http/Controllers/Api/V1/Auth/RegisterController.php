<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendPasswordEmail;
use App\Mail\SendUrlEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Models\JvZooRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ccustemail' => 'required',
            'cproditem' => 'required',
            'ccustname' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $jvZoo = new JvZooRequest();
        $jvZoo->req_data = json_encode($request->all());
        $jvZoo->save();

        // $subscription = 'basic';
        // $productCodes = [
        //     '389301' => 'basic',
        //     '389341' => 'pro',
        //     '395321' => 'recurring',
        //     '389343' => 'whitelabel',
        //     '397322' => 'reseller',
        //     '397319' => 'ProPlus',
        //     '397328' => 'ProPlus'
        // ];
        // $productNames = [
        //     '389301' => 'Basic',
        //     '389341' => 'Pro',
        //     '395321' => 'Recurring',
        //     '389343' => 'Whitelabel',
        //     '397322' => 'Reseller',
        //     '397319' => 'ProPlus',
        //     '397328' => 'ProPlus',
        // ];
        
        $subscription = Subscription::where('product_code',$request->cproditem)->first();
        
        $validator = Validator::make($request->all(), [
            'ccustemail' => 'string|unique:users,email',
        ]);

        if ($validator->fails()) {
            // TODO: update user table with colummn jvzoo request ids
            // TODO: on jvzoo request for existing customer store the jvzoo request table id in user table
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->name         = $request->ccustname;
        $user->email        = $request->ccustemail;
        $user->subscription = $subscription->package_name;

        $pass = Str::random(8);
        $user->password     = bcrypt($pass);
        $user->save();
        $user->roles()->attach(Role::where('name', 'Customer')->first());
        // Auth::login($user);
        // $accessToken = Auth::user()->createToken('authToken')->accessToken;

        $mailData['name']           = $request->ccustname;
        $mailData['email']          = $request->ccustemail;
        $mailData['product_type']   = $user->subscription;

        if($subscription->email_credential){            
            $mailData['password']       = $pass;
            Mail::to($request->ccustemail)->send(new SendPasswordEmail($mailData));
        }else{
            $mailData['signup_url']   = $subscription->url_to_send;
            Mail::to($request->ccustemail)->send(new SendUrlEmail($mailData));
        }
        return response(['user' => $user, 'pass' => $pass]);
        // return response(['user' => $user]);
    }
}
