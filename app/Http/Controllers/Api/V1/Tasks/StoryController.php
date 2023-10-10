<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\MediaStore;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Http\Response;

class StoryController extends Controller
{
    
    /**
     * Create/Update Story 
     * if id found in request it will update the existing story
     * ------------------------------
     * @param Request $request
     * @return JSON object response
     * @author KSSH
     * ------------------------------
     */
    public function save(Request $request)
    {
        $story = Story::find($request->id);
        if(!$story){
            $subsCription = Subscription::where('package_name',Auth::user()->subscription)->first();
            
            // $countDaily  = Story::where('user_id',Auth::user()->id)->whereDate('created_at', Carbon::today()->toDateString())->get()->count();
            // //return response()->json($countDaily)
            // // Daily count validation
            // if($countDaily >= $subsCription->story_per_day){
            //     return response()->json([
            //         'error'=> true,
            //         'message'=> 'Sorry your limit of daily story creation exided',
            //         'data'=> [
            //             'audio_monthly_count'=> $countDaily
            //         ]
            //     ], Response::HTTP_BAD_REQUEST);
            // }

            // Monthly Count Validation
            $start          = Carbon::now()->startOfMonth()->format('Y-m-d');
            $end            = Carbon::now()->endOfMonth()->format('Y-m-d');
            $countMonthly   = Story::where('user_id',Auth::user()->id)->whereBetween('created_at', [$start,$end])->get()->count();
            
            // if($countMonthly >= $subsCription->monthly_story_max && $subsCription->monthly_story_max != 0){
            if($countMonthly >= $subsCription->monthly_story_max){
                return response()->json([
                    'error'=> true,
                    'message'=> 'Sorry your limit of monthly story creation exided',
                    'data'=> [
                        'audio_monthly_count'=> $countMonthly
                    ]
                ], Response::HTTP_BAD_REQUEST);
            }
        }
        // return response()->json($request);
        $updateFlag = true;
        if(!$story){
            // $package = Subscription::where('package_name', Auth::user()->subscription)->first();
            // $usageInfo = SubscriptionUsage::where('user_id',Auth::user()->id)->where('usage_date', date('Y-m-d'))->first();
            // if($usageInfo){
            //     if($package->package_name != 'recurring')
            //         if($usageInfo->stories_today >= $package->story_per_day){
            //             return response()->json([
            //                 'error'=>true,
            //                 'message'=>'Package per day limit exceeded',
            //                 'data'=> [
            //                     'subscription_info'=> $package,
            //                     'usage_info'=> $usageInfo,
            //                 ]
            //             ]);
            //         }else{
            //             $usageInfo->stories_today++;
            //             $usageInfo->save();
            //         }
            // }else{
                $usageInfo = new SubscriptionUsage();
                $usageInfo->user_id     = Auth::user()->id;
                $usageInfo->usage_date  = date('Y-m-d');
                $usageInfo->stories_today++;
                $usageInfo->save();
            // }
            $story = new Story();
            $updateFlag = false;
        }

        $story->cards               = json_encode($request->cards);
        $story->title               = $request->title;
        $story->thumbnail           = $request->thumbnail;
        $story->pw                  = $request->pw;
        $story->background_audio    = $request->background_audio;
        $story->background_image    = $request->background_image;
        $story->background_volume   = $request->background_volume;
        
        if(isset($request->status))
            $story->status      = $request->status;
        if(!$updateFlag){
            $story->audio_id    = $request->audio_id;
            $story->user_id     = Auth::user()->id;
            $story->uuid        = uniqid();
        }
            
        $story->save();

        // Find if chapter is available
        $chapter = Chapter::where('name',$request->chapter_name)->where('user_id',Auth::user()->id)->first();
        
        if($chapter){
            $story->chapter_id = $chapter->id;
            $story->save();
        }        

        $story = Story::with('audio')->where('id',$story->id)->where('user_id',Auth::user()->id)->first();
        $story->cards = json_decode($story->cards);
        return response()->json([
            'success'=>true,
            'message'=>'Story Saved Successfully',
            'data'=> ['story' => $story]
        ]);
    }

    /**
     * All Stories of authenticated user
     * ------------------------------
     * @param Request $request
     * @return JSON object response
     * @author KSSH
     * ------------------------------
     */
    public function stories(Request $request)
    {
        $stories = Story::with('audio')->where('user_id',Auth::user()->id)->orderBy('updated_at','desc')->get();
        if($stories){
            foreach($stories as $story)
                $story->cards = json_decode($story->cards);

            return response()->json([
                'success'=>true,
                'message'=>'Requested Story Found Successfully.',
                'data'=> ['stories' => $stories]
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No Story found'
            ]);
        }
    }

    /**
     * Find Story by id
     * ------------------------------
     * @param Request $request
     * @return JSON object response
     * @author KSSH
     * ------------------------------
     */
    public function find(Request $request)
    {
        $story = Story::with('audio')->where('id',$request->id)->where('user_id',Auth::user()->id)->first();
        if($story){
            $story->cards = json_decode($story->cards);
            $story->audio->meta_info = json_decode($story->audio->meta_info);
            return response()->json([
                'success'=>true,
                'message'=>'Requested Story Found Successfully.',
                'data'=> ['story' => $story]
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No Story found'
            ]);
        }
    }

    /**
     * Find Story by Chapter id
     * ------------------------------
     * @param Request $request
     * @return JSON object response
     * @author KSSH
     * ------------------------------
     */
    public function findByChapter(Request $request)
    {
        $stories = Story::with('audio')->where('chapter_id',$request->id)->where('user_id',Auth::user()->id)->get();
        
        if($stories){
            foreach($stories as $story){
                $story->cards = json_decode($story->cards);
                $story->audio->meta_info = json_decode($story->audio->meta_info);
            }
            return response()->json([
                'success'=>true,
                'message'=>'Requested Story Found Successfully.',
                'data'=> ['stories' => $stories]
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No Story found'
            ]);
        }
    }

    /**
     * Find Story by UUID
     * ------------------------------
     * @param Request $request
     * @return JSON object response
     * @author KSSH
     * ------------------------------
     */
    public function findByUuid(Request $request)
    {
        $stat = ['draft','published'];
        if (!Auth::guard('api')->check()) $stat = ['published'];
       
        $story = Story::where('uuid',$request->uuid)->whereIn('status',$stat)->first();
        $user = User::find($story->user_id);
        if($user && $user->status == 0){

            return response()->json([
                'error'=>true,
                'message'=>'Story blocked. contact the author to reactivate'
            ]);
        }
        if($story){
            $story->total_view++;
            $story->save();
            
            $story->user_name           = $user->name; 
            $story->user_subscription   = $user->subscription; 
            // $story->user_name = User::find($story->user_id)->name; 
            
            if($audio = MediaStore::where('media_type','audio')->where('id',$story->audio_id)->first()) {             
                $story->audio_url = $audio->local_path;   
                $story->audio_meta_info = json_decode($audio->meta_info);
            }  
            else{   
                $story->audio_url = 'no-audio';  
                $story->audio_meta_info = null; 
            }

            $story->cards = json_decode($story->cards);  
            if($story->chapter_id > 0)
                $story->chapter_name = Chapter::find($story->chapter_id)->name;              

            return response()->json([
                'success'=>true,
                'message'=>'Requested Story Found Successfully.',
                'data'=> ['story' => $story]
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No Story found'
            ]);
        }
    }

    /**
     * Delete Story by id
     * ------------------------------
     * @param Request $request
     * @return JSON object response
     * @author KSSH
     * ------------------------------
     */
    public function delete(Request $request)
    {
        $story = Story::where('id',$request->id)->where('user_id',Auth::user()->id)->delete();
        if($story){
            return response()->json([
                'success'=>true,
                'message'=>'Story Deleted Successfully.'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No Story found to delete with the id requested'
            ]);
        }
    }

    // like , dislike, hart, satisfied, sad, angry
    public function reaction(Request $request)
    {
        $story = Story::where('uuid',$request->uuid)->first();        

        if($story){
            if($request->reaction == 'like') $story->like++;
            else if($request->reaction == 'dislike') $story->dislike++;
            else if($request->reaction == 'heart') $story->heart++;
            else if($request->reaction == 'satisfied') $story->satisfied++;
            else if($request->reaction == 'sad') $story->sad++;
            else if($request->reaction == 'angry') $story->angry++;
            else
                return response()->json([
                    'error'=>true,
                    'message'=>'Request type is wrong'
                ]);
            
            $story->save();

            $story->cards = json_decode($story->cards);
            return response()->json([
                'success'=>true,
                'message'=> $request->reaction.' added Successfully.',
                'data'=> ['story' => $story]
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No Story found'
            ]);
        }
    }
}
