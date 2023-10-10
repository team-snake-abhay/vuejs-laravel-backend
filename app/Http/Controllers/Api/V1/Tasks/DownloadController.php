<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    public function download(Request $request)
    {
        if(Auth::user()->subscription != 'whitelabel'){
            return response()->json([
                'success' => false,
                'message' => 'Sorry you are not authorized'
            ],404);
        }

        $url = Storage::url('downloads/storify-project.zip');
        return response()->json([
            'success' => true,
            'url' => $url
        ]);
    }
}
