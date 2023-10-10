<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\MediaStore;
use Exception;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg|max:7168'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'=> true,
                'data'=> [
                    'message'=>$validator->messages()
                ],
            ]);
        }

        if ($request->hasFile('image')) {
            try {
                //get file extension
                $extension = $request->file('image')->getClientOriginalExtension();

                //filename to store
                $fileNameToStore = 'I_'.uniqid().'.'.$extension;

                //Image intervention 
                $img = Image::make(fopen($request->file('image'), 'r+'));
                // resize the image to a width of 300 and constrain aspect ratio (auto height)
                $img->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(storage_path('app/public/uploads/images/'.$fileNameToStore));
                // end of image intervention
                
                //Storage::disk('public')->put('uploads/images/'. $fileNameToStore, fopen($request->file('image'), 'r+'));

                $mediaStorageObj = new MediaStore();
                $mediaStorageObj->title         = $request->title;
                $mediaStorageObj->local_path    = url('/storage/uploads/images/'.$fileNameToStore);
                $mediaStorageObj->user_id       = Auth::user()->id;
                $mediaStorageObj->media_type    = 'image';
                $mediaStorageObj->save();

                return response()->json([
                    'success'=> true,
                    'data'=> [
                        'mediaObject'=>$mediaStorageObj
                    ],
                ]);
            } catch(Exception $e) {
                return response()->json(['error'=>$e->getMessage()]);
            }
        }
    }

    public function getAllImageByUser()
    {
        $mediaStorageObj = MediaStore::where('user_id',Auth::user()->id)->where('media_type','image')->get();
        if($mediaStorageObj)
        {
            return response()->json([
                'success'=> true,
                'data'=> [
                    'mediaObject'=>$mediaStorageObj
                ],
            ]);
        }else{
            return response()->json([
                'error'=> true,
                'message'=> "No image found"
            ]);
        }

    }

    public function getImageById(Request $request)
    {
        $mediaStorageObj = MediaStore::where('user_id',Auth::user()->id)
                                    ->where('media_type','image')
                                    ->where('id',$request->id)
                                    ->first();
        if($mediaStorageObj)
        {
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


    private function getImageMimeType($imagedata)
    {
        $imagemimetypes = array(
            "jpeg" => "FFD8",
            "png" => "89504E470D0A1A0A",
            "gif" => "474946",
            "bmp" => "424D",
            "tiff" => "4949",
            "tiff" => "4D4D"
        );

        foreach ($imagemimetypes as $mime => $hexbytes)
        {
            $bytes = $this->getBytesFromHexString($hexbytes);
            if (substr($imagedata, 0, strlen($bytes)) == $bytes)
            return $mime;
        }

        return NULL;
    }

    private function getBytesFromHexString($hexdata)
    {
        for($count = 0; $count < strlen($hexdata); $count+=2)
            $bytes[] = chr(hexdec(substr($hexdata, $count, 2)));

        return implode($bytes);
    }

}
