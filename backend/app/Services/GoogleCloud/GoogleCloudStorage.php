<?php

namespace App\Services\GoogleCloud;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Storage\WriteStream;


class GoogleCloudStorage
{
    
    public static function upload($storageObject, $contents)
    {
                
        try {
            $storage = new StorageClient([
                'keyFilePath' => base_path(env('GOOGLE_CLOUD_KEY_FILE')),
            ]);
            //Set Upload bucket
            $bucket = $storage->bucket(env('GOOGLE_CLOUD_STORAGE_BUCKET'));
            $writeStream = new WriteStream(null, [
                'chunkSize' => 1024 * 256, // 256KB
            ]);
        
            $uploader = $bucket->getStreamableUploader($writeStream, [
                'name' => $storageObject,
            ]);

            $writeStream->setUploader($uploader);
            $stream = fopen($contents, 'r');
            while (($line = stream_get_line($stream, 1024 * 256)) !== false) {
                $writeStream->write($line);
            }
            $writeStream->close();

        
            // is it succeed ?
            return $storageObject != null;
        } catch (\Google\Cloud\Core\Exception\GoogleException $exception) {
            // maybe invalid private key ?
            Log::error($exception);
            return false;
        }

        // set which bucket to work in
        
    }

    /**
     * 
     * 
     */
    public static function uploadGsUtil($bucket, $file){
        $ret = [];
        
        try{
            $cmd = env('GSUTIL_PATH').' cp '.$file.' gs://'.$bucket.'/audios/';
            exec($cmd,$output,$result);
            $ret[1] = ['cmd'=>$cmd, 'output'=>$output, 'result'=>$result]; 
        }catch(Exception $e){
            return response()->json([
                'error'=> true,
                'message'=> 'Terminal cmd Exception',
                'data'=>$e->getMessage()
            ]);
        }     
        return $ret;    
    }
}