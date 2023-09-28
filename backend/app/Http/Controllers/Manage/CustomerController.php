<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {           
        return view('admin.customer')
            ->with('users', User::with('roles')->get());
    }

    public function subscriptionUpdate(Request $request)
    {
        $user = User::find($request->id);
        //dd($request);
        if (!$request->id) {            
            return redirect()->back()->with('error','Sorry no user found');
        }
        //dd($user);
        $user->subscription = $request->subscription;
        
        $user->save();

        return redirect()->back()->with('success', 'Customer subscription updated successfully');
    }   

    public function customerStatus(Request $request)
    {
        $user = User::find($request->id);
        //dd($request);
        if (!$request->id) {            
            return redirect()->back()->with('error','Sorry no user found');
        }
        //dd($user);
        $user->status = $request->status;

        $user->tokens->each(function($token, $key) { $token->delete(); });

        $user->save();

        return redirect()->back()->with('success', 'Customer subscription updated successfully');
    }    
}