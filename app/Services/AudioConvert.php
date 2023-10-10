<?php

namespace App\Services;

class AudioConvert
{
    public static function convertAudio($fileToConvert, $fileConverted)
    {
        $inputFile = storage_path('app/public/uploads/audios/'.$fileToConvert);
        $outputFile = storage_path('app/public/uploads/audios/'.$fileConverted);
        $cmd = 'ffmpeg -i '.$inputFile.' -ac 1 '.$outputFile;
        
        if($inputFile != $outputFile)
            exec($cmd,$output,$result);
        return ['cmd'=>$cmd, 'output'=>$output, 'result'=>$result, 'outputFile'=>$outputFile]; 
          
        // return $outputFile;
    }
}