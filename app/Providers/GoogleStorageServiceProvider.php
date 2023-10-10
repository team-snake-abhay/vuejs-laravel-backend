<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;

class GoogleStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extends('gcs', function($app, $config){
            $storage = new StorageClient([
                'projectId'=>$config['project_id'],
                'keyFilePath'=>$config['key_file']
            ]);

            return $storage->bucket($config['bucket']);
            
        });
        

        

        // Upload a file to the bucket.
        // $bucket->upload(
        //     fopen('/audio/file.txt', 'r')
        // );

        // Using Predefined ACLs to manage object permissions, you may
        // upload a file and give read access to anyone with the URL.
        // $bucket->upload(
        //     fopen('/data/file.txt', 'r'),
        //     [
        //         'predefinedAcl' => 'publicRead'
        //     ]
        // );

        // // Download and store an object from the bucket locally.
        // $object = $bucket->object('file_backup.txt');
        // $object->downloadToFile('/data/file_backup.txt');
    }
}