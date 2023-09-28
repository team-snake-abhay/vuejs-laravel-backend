<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\UserGenerator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminUserController extends Controller
{
    use UserGenerator;
    public function list()
    {
        return view('admin.roles')
            ->with('users',User::with('roles')->get());
    }  
    

    public function show()
    {   
        // $user = User::with('roles')->get();
        // foreach($user as $role)
        //     print($role);

        // dd( $user[0]->roles);

        return view('admin.users')
            ->with('users', User::with('roles')->get());
    }

    public function save(Request $request)
    {
        //dd($request);
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
            $user->username = $this->username($user->id, 'u');
            $role = Role::where('id', $request['role'])->first();
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

    public function edit(Request $request)
    {
        return json_encode(User::find($request['editId']));
    }  

    public function viewProfile()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return view('admin.profile')
            ->with('user', $user);
    }

    public function saveProfile(Request $request)
    { //dd($request);
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|unique:users,mobile,'.$request['id'],
            'email' => 'required|email|unique:users,email,'.$request['id'],
        ]);
        $user = User::where('id', $request['id'])->first(); //dd($user);
        $user->name = $request['name'];
        $user->nid = $request['nid'];
        $user->mobile = $request['mobile'];
        $user->email = $request['email'];
        if ($request['password'] != null) {
            $user->password = bcrypt($request['password']);
        }
        $user->address = $request['address'];
        $upDir = public_path('storage/images/users/');
        $imgName = date('YmdHis');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $user->image = 'image-'.$imgName.'.'.$image->getClientOriginalExtension();
            $image->move($upDir, $user->image);
        }
        $user->save();

        return redirect('manage/profile')->with('success', 'Data Updated Successfully!');
    }
}