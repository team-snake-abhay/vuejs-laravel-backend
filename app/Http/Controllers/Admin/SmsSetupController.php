<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmsSetup;

class SmsSetupController extends Controller
{
    public function index(Request $request){
        return view('admin.smsSetup')->with('config',SmsSetup::find(1));
    }

    public function store(Request $request){
        $request->validate([
            'username'=> 'required',
            'token'=> 'required',
            'masking'=> 'required',
            'base_uri'=> 'required',
            'msg_template'=> 'required',
            'msg_type'=> 'required'
        ]);

        $smsSetup = SmsSetup::find($request->id);
        $smsSetup->username = $request->username;
        $smsSetup->token = $request->token;
        $smsSetup->masking = $request->masking;
        $smsSetup->base_uri = $request->base_uri;
        $smsSetup->msg_template = $request->msg_template;
        $smsSetup->msg_type= $request->msg_type;
        $smsSetup->save();

        return redirect()->back()->with('success', 'Data Saved Successfully!');
    }
}
