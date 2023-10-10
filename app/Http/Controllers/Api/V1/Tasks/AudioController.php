<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Google\Cloud\Storage\StorageClient;

use App\Services\GoogleCloud\GoogleCloudStorage;
use App\Services\AudioConvert;
use App\Models\MediaStore;
use App\Models\Story;
use App\Models\Subscription;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Carbon\Carbon;

class AudioController extends Controller
{

    private $bucketName =  '';
    private $keyFilePath =  '';
    
    public function __construct(){
        $this->bucketName = env('GOOGLE_CLOUD_STORAGE_BUCKET');
        $this->keyFilePath = base_path(env('GOOGLE_CLOUD_KEY_FILE'));
    }

    public function save(Request $request){
   
        $subsCription = Subscription::where('package_name',Auth::user()->subscription)->first();
        
        // $countDaily  = MediaStore::where('user_id',Auth::user()->id)->whereDate('created_at', Carbon::today()->toDateString())->get()->count();
        // // return response()->json([$countDaily,$subsCription->story_per_day]);
        // // Daily count validation
        // if($countDaily >= $subsCription->story_per_day){ 
        //     return response()->json([
        //         'error'=> true,
        //         'message'=> 'Sorry your limit of daily uploading audio exided',
        //         'data'=> [
        //             'audio_monthly_count'=> $countDaily
        //         ]
        //     ], Response::HTTP_BAD_REQUEST);
        // }

        $start  = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end    = Carbon::now()->endOfMonth()->format('Y-m-d');
        $countMonthly  = MediaStore::where('media_type','audio')->where('user_id',Auth::user()->id)->whereBetween('created_at', [$start,$end])->get()->count();
        // Monthly Count Validation
        if($countMonthly >= $subsCription->monthly_story_max && $subsCription->monthly_story_max != 0){
            return response()->json([
                'error'=> true,
                'message'=> 'Sorry your limit of monthly uploading audio exided',
                'data'=> [
                    'audio_monthly_count'=> $countMonthly
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        if($request->has('audio_length'))
        {
            $validator = Validator::make($request->all(), [
                'audio' => 'required',
            ]);

            if ($subsCription->audio_length_max < $request->audio_length) {
                return response()->json([
                    'error'=> true,
                    'message'=> 'Audio lenght should not exceed '.$subsCription->audio_length_max.' sec'
                ], Response::HTTP_BAD_REQUEST);
            }
            // return response()->json([$subsCription->audio_length_max, $request->audio_length]);
        }else{
            $validator = Validator::make($request->all(), [
                'audio' => 'audio|duration_min:3|duration_max:'.$subsCription->audio_length_max,
            ]);
        }

        
        
        if ($validator->fails()) {
            // return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            return response()->json([
                'error'=> true,
                // 'message'=> 'No file found to upload ',
                'message'=> $validator->messages()
                // 'data'=>$validator->messages()
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($request->hasFile('audio')) 
        {
            //get file size
            $fileSize = $request->file('audio')->getSize();

            //get file extension
            $extension = $request->file('audio')->getClientOriginalExtension();

            //filename to store
            $fileNameWithoutExt = 'A_'.uniqid();
            $inputFile = $fileNameWithoutExt.'.'.$extension;
            $convertToExtention = 'flac';
            $fileConverted = $fileNameWithoutExt.'.'.$convertToExtention;

            Storage::put('public/uploads/audios/'. $inputFile, fopen($request->file('audio'), 'r+'),'public');

            // $convertResponse = AudioConvert::convertAudio($inputFile, $fileConverted);
            // $gs = GoogleCloudStorage::uploadGsUtil($this->bucketName, $convertResponse['outputFile']);
            
            try {            
               
                $mediaStorageObj = new MediaStore();
                $mediaStorageObj->title         = $request->title;
                $mediaStorageObj->local_path    = url('/storage/uploads/audios/'.$inputFile);
                // $mediaStorageObj->gs_path       = 'gs://'.$this->bucketName.'/audios/'.$fileConverted;
                $mediaStorageObj->user_id       = Auth::user()->id;                
                $mediaStorageObj->media_type    = 'audio';
                $mediaStorageObj->meta_info     = json_encode(['audio_length'=>$request->audio_length,'file_size'=> $fileSize]);
                $mediaStorageObj->save();

                $mediaStorageObj->meta_info = json_decode($mediaStorageObj->meta_info);

                return response()->json([
                    'success'=> true, 
                    'data'=> [
                        'mediaStorageObj'=>$mediaStorageObj,
                        // 'convertResponse'=>$convertResponse,
                        // 'gsutil'=> $gs
                    ], 
                ]);   
                
            } catch(Exception $e) {
                return response()->json([
                    'error'=> true,
                    'message'=> 'Exception',
                    'data'=>json_decode($e->getMessage())
                ]);
            }
        }else{
            return response()->json([
                'error'=> true,
                'message'=> 'No file found to upload ',
                'data'=>$request->file('audio')
            ]);
        }
    }

    

    public function getAllAudioByUser()
    {
        $mediaStorageObj = MediaStore::where('user_id',Auth::user()->id)
                            ->where('media_type','audio')
                            //->makeHidden(['transcript'])
                            ->get();
        if($mediaStorageObj)
        {
            foreach($mediaStorageObj as $media){
                $media->meta_info = json_decode($media->meta_info);
                $media->transcript = json_decode($media->transcript);
            }                

            return response()->json([
                'success'=> true, 
                'data'=> [
                    'mediaObject'=>$mediaStorageObj
                ], 
            ]);
        }else{
            return response()->json([
                'error'=> true, 
                'message'=> "No audio found"
            ]);
        }            
    }

    public function getAudioById(Request $request)
    {
        $mediaStorageObj = MediaStore::where('user_id',Auth::user()->id)
                            ->where('media_type','audio')
                            ->where('id',$request->id)
                            ->first();
        if($mediaStorageObj)
        {
            $mediaStorageObj->transcript = json_decode($mediaStorageObj->transcript);
            $mediaStorageObj->meta_info = json_decode($mediaStorageObj->meta_info);
            return response()->json([
                'success'=> true, 
                'data'=> [
                    'mediaObject'=>$mediaStorageObj
                ], 
            ]);
        }else{
            return response()->json([
                'error'=> true, 
                'message'=> "No audio found"
            ]);
        }            
    }

    public function deleteAudioById(Request $request)
    {
        $story = Story::where('audio_id',$request->id)->first();

        if(!$story){
            $mediaStorageObj = MediaStore::where('user_id',Auth::user()->id)
                            ->where('media_type','audio')
                            ->where('id',$request->id)
                            ->delete();
                            
            if($mediaStorageObj)
                return response()->json([
                    'success'=> true, 
                    'message'=> 'Requested audio deleted successfully'                
                ]);
            else 
                return response()->json([
                    'error'=> true, 
                    'message'=> 'No audio found to delete'                
                ]);
        }else{
            return response()->json([
                'error'=> true, 
                'message'=> "audio cannot be deleted, it is being used in a story"
            ]);
        }            
    }

    public function getFileInfo(Request $request)
    {
        $cloudPath = $request->get('cloudPath');
        try {
            $storage = new StorageClient([
                'keyFilePath' => $this->keyFilePath,
            ]);
        } catch (Exception $e) {
            // maybe invalid private key ?
            print $e;
            return false;
        }
        // set which bucket to work in

        $bucket = $storage->bucket($this->bucketName);
        $object = $bucket->object($cloudPath);
        if (!$object->exists()) {
            echo "Object: '$cloudPath' is not exists";
            exit();
        }
        return $object->info();
    }

    public function delete_object($objectName)
    {
        $storage = new StorageClient([
            'keyFilePath' => $this->keyFilePath,
        ]);
        $bucket = $storage->bucket($this->bucketName);
        $object = $bucket->object($objectName);
        $object->delete();
    }

    
}
