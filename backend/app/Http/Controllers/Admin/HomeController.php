<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Public\Basic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    
    public function view()
    {
        $basic = Basic::all()->first();

        return view('admin.basic')
            ->with('basic', $basic);
    }

    public function add(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'contact_number' => 'required',
            'address' => 'required',
            'email' => 'required|email',
        ]);
        $basic = Basic::first();
        if (!$basic) {
            $basic = new Basic();
        }

        $basic->company_name = $request['company_name'];
        $basic->contact_number = $request['contact_number'];
        $basic->email = $request['email'];
        $basic->address = $request['address'];
        $basic->facebook_link = $request['facebook_link'];
        $basic->youtube_link = $request['youtube_link'];
        $basic->linkedin_link = $request['linkedin_link'];
        $basic->instagram_link = $request['instagram_link'];
        $upDir = public_path('storage/images/pages/');
        $imgName = date('YmdHis');
        if ($request->hasFile('header_image')) {
            $image_path = public_path('storage/images/pages/') . $basic->header_image;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $image = $request->file('header_image');
            $basic->header_image = 'basic-image-header-' . $imgName . '.' . $image->getClientOriginalExtension();
            $image->move($upDir, $basic->header_image);
        }
        $basic->created_by = Auth::user()->id;
        $basic->save();

        return redirect()->back()->with('success', 'Data Saved Successfully!');
    }

}