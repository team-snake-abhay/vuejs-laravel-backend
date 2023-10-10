<?php

namespace App\Services\GoogleCloud;

use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\StreamingRecognitionConfig;
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\StreamingRecognizeRequest;



class GoogleCloudSpeech
{

    /**
     * @param string $audioFile path to an audio file
     */
    public static function streamingRecognize(string $audioFile)
    {
        // change these variables if necessary
        $encoding = AudioEncoding::LINEAR16;
        $sampleRateHertz = 32000;
        $languageCode = 'en-US';
        $enableWordTimeOffsets = true;

        $speechClient = new SpeechClient([
            'credentials' => base_path(env('GOOGLE_CLOUD_KEY_FILE'))
        ]);
        try {
            $config = (new RecognitionConfig())
                ->setEncoding($encoding)
                ->setSampleRateHertz($sampleRateHertz)
                ->setEnableWordTimeOffsets($enableWordTimeOffsets)
                ->setLanguageCode($languageCode);

            $strmConfig = new StreamingRecognitionConfig();
            $strmConfig->setConfig($config);

            $strmReq = new StreamingRecognizeRequest();
            $strmReq->setStreamingConfig($strmConfig);

            $strm = $speechClient->streamingRecognize();
            $strm->write($strmReq);

            $strmReq = new StreamingRecognizeRequest();
            $content = file_get_contents($audioFile);
            $strmReq->setAudioContent($content);
            $strm->write($strmReq);

            foreach ($strm->closeWriteAndReadAll() as $response) {
                foreach ($response->getResults() as $result) {
                    foreach ($result->getAlternatives() as $alt) {
                        $startTime = $alt->getStartTime();
                        $arr[] = [
                            "word" => $alt->getWord(),
                            "timestamp" => (float)number_format((float)json_decode($startTime->serializeToJsonString()), 2, '.', '')
                        ];
                    }
                }
            }
        } finally {
            $speechClient->close();
        }
    }

    // public function speechToText($fileName,$extension)
    public static function speechToText($gsFile)
    {
        
        $encoding = AudioEncoding::ENCODING_UNSPECIFIED;//for flac
        $languageCode = 'en-US';
        //$audioChannelCount = 1;
        $enableWordTimeOffsets = true;

        // set string as audio content
        $audio = (new RecognitionAudio())->setUri($gsFile);

        // set config
        $config = (new RecognitionConfig())
            ->setEncoding($encoding)
            ->setEnableWordTimeOffsets($enableWordTimeOffsets)
            //->setAudioChannelCount($audioChannelCount)
            // ->setSampleRateHertz($sampleRateHertz)
            ->setEnableAutomaticPunctuation(true)
            ->setLanguageCode($languageCode);

        // create the speech client
        $client = new SpeechClient([
            'credentials' => base_path(env('GOOGLE_CLOUD_KEY_FILE'))
        ]);

        // create the asyncronous recognize operation
        $operation = $client->longRunningRecognize($config, $audio);
        $operation->pollUntilComplete();

        if ($operation->operationSucceeded()) {
            $response = $operation->getResult();
            
            $transcript = "";
            $arr = [];
            foreach ($response->getResults() as $result) {

                $alternatives = $result->getAlternatives();
                $mostLikely = $alternatives[0];
                $transcript .= $mostLikely->getTranscript();
                // $confidence = $mostLikely->getConfidence();

                foreach ($mostLikely->getWords() as $wordInfo) {
                    $startTime = $wordInfo->getStartTime();
                    $arr[] = [
                        "word" => $wordInfo->getWord(),
                        "timestamp" => (float)number_format((float)json_decode($startTime->serializeToJsonString()), 2, '.', '')
                    ];
                }
            }
            return $arr;            
        } else {
            return $operation->getError();
        }

        $client->close();
    }

    

}