<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\StoryComment;

class CommentController extends Controller
{
    public function new(Request $request)
    {        
        // return response()->json($request);
        
        $comment = new StoryComment();        
        $comment->story_id  = $request->story_id;
        $comment->comment   = $request->comment;
        $comment->name      = $request->name;
        $comment->email     = $request->email;
        $comment->save();

        if($comment){
            return response()->json([
                'success'=>true,
                'message'=>'Comment Saved Successfully',
                'data'=> ['comment' => $comment]
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'Sorry, something went wrong'
            ]);
        }
    }

    public function commentsByStory(Request $request)
    {
        $comments = StoryComment::where('story_id',$request->story_id)->get();
        if($comments){
            return response()->json([
                'success'=>true,
                'message'=>'Requested Comments',
                'data'=> ['comments' => $comments]
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No Comments found'
            ]);
        }
    }
}