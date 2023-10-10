<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; // Import the Str class if not already imported



class CustomerController extends Controller
{

    public function username($id, $prefix = 'u')
{
    // Generate a unique username based on the given ID and prefix
    return $prefix . $id;
}
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


    public function store(Request $request)
    {
        if (!$request['id']) {
            $request->validate([
                'name' => 'required',
                'mobile' => 'required|unique:users',
                'role' => 'required',
                'email' => 'required|email|unique:users',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $user = new User();
            if ($request['role'] == 1) {
                $user->url = '/admin/dashboard';
            } elseif ($request['role'] == 2) {
                $user->url = '/manage/dashboard';
            } else {
                $user->url = '/viewer/dashboard';
            }
            $user->created_by = Auth::user()->id;
            $user->save();
            // dd($user);
            $user->username = $this->username($user->id, 'u');
            $role = Role::where('id', $request['role'])->latest()->first();
            $user->roles()->attach($role);
        } else {
            $request->validate([
                'name' => 'required',
                'mobile' => 'required|unique:users,mobile,'.$request['id'],
                'email' => 'required|email|unique:users,email,'.$request['id'],
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $user = User::where('id', $request['id'])->first();
        }
        //dd($user);
        $user->name = $request['name'];
        $user->mobile = $request['mobile'];
        $user->email = $request['email'];
        if ($request['password'] != null) {
            $user->password = bcrypt($request['password']);
        } else {
            if (!$request['id']) {
                $user->password = bcrypt(12345678);
            }
        }
        if ($request['status'] == 'on') {
            $user->status = 1;
        } else {
            $user->status = 0;
        }
        $user->address = $request['address'];
        $upDir = public_path('storage/images/users/');
        $imgName = date('YmdHis');
        if ($request->hasFile('image')) {
            $image_path = public_path('storage/images/users/').$user->image;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $image = $request->file('image');
            $user->image = 'image-'.$imgName.'.'.$image->getClientOriginalExtension();
            $image->move($upDir, $user->image);
        }
        $user->save();

        return redirect()->back()->with('success', 'Data Saved Successfully!');
    }
}

