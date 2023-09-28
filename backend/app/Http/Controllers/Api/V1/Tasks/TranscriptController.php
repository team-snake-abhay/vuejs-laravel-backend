<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaStore;
// use App\Services\GoogleCloud\GoogleCloudSpeech;
use App\Services\DeepGram\DeepGramConverter;

class TranscriptController extends Controller
{   

    public function transcribe(Request $request)
    {
        $mediaStorageObj = MediaStore::find($request->id);
        
        if(!$mediaStorageObj)
            return response()->json([
                'error'=> true,
                'message'=> 'Requested Media not found',
                'data'=>[
                    'audio_id'=>$request->id
                ]
            ]);
        
        // $transcript = GoogleCloudSpeech::speechToText($mediaStorageObj->gs_path);
        try{
            $transcript = DeepGramConverter::convert($mediaStorageObj->local_path);
        }catch(Exception $e){
            return $e;
        }
        
        if($transcript){
            $mediaStorageObj->transcription_status  = 1;
            $mediaStorageObj->transcript            = $transcript['results']['channels'][0]['alternatives'][0]['words'];
            $mediaStorageObj->transcript            = $transcript['results']['channels'][0]['alternatives'][0]['words'];
            
            $metaInfo = json_decode($mediaStorageObj->meta_info);
            $mediaStorageObj->meta_info     = json_encode(['audio_length'=>$transcript['metadata']['duration'],'file_size'=> $metaInfo->file_size]);
            $mediaStorageObj->save();
            $mediaStorageObj->meta_info     = json_decode($mediaStorageObj->meta_info);

            return response()->json([
                'success'=> true, 
                'data'=> [
                    'mediaStorageObj'=>$mediaStorageObj
                ], 
            ]);
        }else{
            return response()->json([
                'error'=> true,
                'message'=> 'Request failed or flac conversion not completed yet, try once later',
                'data'=>[
                    'audio_id'=>$request->id
                ]
            ]);
        }        
    }

    public function edit(Request $request)
    {
        $mediaStorageObj = MediaStore::find($request->id);

        if(!$mediaStorageObj)
            return response()->json([
                'error'=> true,
                'message'=> 'Requested Media not found',
                'data'=>[
                    'audio_id'=>$request->id
                ]
            ]);

        $mediaStorageObj->transcript = $request->transcript;
        $mediaStorageObj->save();

        return response()->json([
            'success'=> true, 
            'data'=> [
                'mediaStorageObj'=>$mediaStorageObj
            ], 
        ]);
        
    }
}