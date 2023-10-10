<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Role;
use App\Helpers\OtpGenerator;
use App\Services\TextMessage\DefaultProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('adminlte.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email1' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'mobile' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email1,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);
        
        $user->roles()->attach(Role::where('name', 'Customer')->first());
        event(new Registered($user));

        $user->otp = OtpGenerator::generateNumericOTP(4);
        $user->save();

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email1;
        $customer->mobile = $request->mobile;
        $customer->user_id =  $user->id;
        $customer->save();
//dd($customer);
        $sms = new DefaultProvider();
        $sms->sendOtp($user->mobile,$user->otp);

        Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);
        //return redirect(Auth::user()->url);
        return redirect()->back()
            ->with('msg','Registration Successfull, Pleasee verify your mobile number, we sent verification OTP to your mobile.');
    }
}
