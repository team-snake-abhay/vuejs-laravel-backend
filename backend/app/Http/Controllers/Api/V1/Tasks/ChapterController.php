<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function new(Request $request)
    {
        $request->validate([
            "name" => "required|unique:chapters"
        ]);

        $chapter = new Chapter();
        $chapter->name      = $request->name;
        $chapter->user_id   = Auth::user()->id;
        $chapter->save();

        return response()->json([
            'success'=>true,
            'message'=>'Chapter Saved Successfully',
            'data'=> ['chapter' => $chapter]
        ]);
    }

    public function chaptersByUser()
    {
        return response()->json([
            'success'=>true,
            'message'=>'List of all Chapter',
            'data'=> ['chapters' => Chapter::where('user_id',Auth::user()->id)->get()]
        ]);
    }
}
