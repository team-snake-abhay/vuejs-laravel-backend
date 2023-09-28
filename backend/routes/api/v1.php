<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::namespace('App\Http\Controllers\Api\V1\Auth')
    ->group(function(){     
        // All Auth related routes   
        Route::post('register',['uses' => 'RegisterController@register'])->name('api.v1.auth.register');
        Route::post('login',['uses' => 'LoginController@login'])->name('api.v1.auth.login');
        Route::post('forgot-password',['uses' => 'ForgotPasswordController@forgotPass'])->name('api.v1.auth.forgot-password');

        Route::middleware('auth:api')
            ->group(function(){                        
                Route::post('logout',['uses' => 'LoginController@logout'])->name('api.v1.auth.logout');
                Route::post('user',['uses' => 'LoginController@userInfo'])->name('api.v1.auth.user');
                Route::post('user/change-password',['uses' => 'ForgotPasswordController@changePassword'])->name('api.v1.auth.user.change.password');
        });
});

Route::namespace('App\Http\Controllers\Api\V1\Tasks')
    ->group(function(){  
    Route::middleware('auth:api')
        ->group(function(){        
            Route::get('download',['uses' => 'DownloadController@download'])->name('api.v1.download');
    });
});

Route::namespace('App\Http\Controllers\Api\V1\Tasks')
    ->prefix('p')
    ->group(function(){        
        Route::get('story/{uuid}',['uses' => 'StoryController@findByUuid'])->name('api.v1.story.public');
        Route::post('story/{uuid}/reaction',['uses' => 'StoryController@reaction'])->name('api.v1.story.reaction');

        Route::post('story/comment/new',['uses' => 'CommentController@new'])->name('api.v1.story.comment.new');
        Route::post('story/comments',['uses' => 'CommentController@commentsByStory'])->name('api.v1.story.comments');
});
     
// Story routes
Route::namespace('App\Http\Controllers\Api\V1\Tasks')
    ->middleware('auth:api')
    ->prefix('story')
    ->group(function(){        
        Route::post('new',['uses' => 'StoryController@save'])->name('api.v1.story.new');
        Route::get('user',['uses' => 'StoryController@stories'])->name('api.v1.story.all');
        Route::delete('delete',['uses' => 'StoryController@delete'])->name('api.v1.story.delete');
        Route::post('id',['uses' => 'StoryController@find'])->name('api.v1.story.find');

        Route::post('chapter',['uses' => 'StoryController@findByChapter'])->name('api.v1.story.chapter');           
});

// Chapter routes
Route::namespace('App\Http\Controllers\Api\V1\Tasks')
    ->middleware('auth:api')
    ->prefix('chapter')
    ->group(function(){        
        Route::post('new',['uses' => 'ChapterController@new'])->name('api.v1.chapter.new');
        Route::get('user',['uses' => 'ChapterController@chaptersByUser'])->name('api.v1.chapter.user');
});

/*
| All sudio related routes
*/
Route::namespace('App\Http\Controllers\Api\V1\Tasks')
    ->prefix('audio')
    ->middleware('auth:api')
    ->group(function(){        
        Route::post('save',['uses' => 'AudioController@save'])->name('api.v1.audio.save');
        Route::post('transcribe',['uses' => 'TranscriptController@transcribe'])->name('api.v1.audio.transcribe');
        Route::post('transcribe/edit',['uses' => 'TranscriptController@edit'])->name('api.v1.audio.transcribe.edit');
        Route::get('user/all',['uses' => 'AudioController@getAllAudioByUser'])->name('api.v1.audio.all');
        Route::post('id',['uses' => 'AudioController@getAudioById'])->name('api.v1.audio.id.get');
        Route::delete('delete',['uses' => 'AudioController@deleteAudioById'])->name('api.v1.audio.id.delete');
});

/*
| All image related routes
*/
Route::namespace('App\Http\Controllers\Api\V1\Tasks')
    ->prefix('image')
    ->middleware('auth:api')
    ->group(function(){        
        Route::post('save',['uses' => 'ImageController@save'])->name('api.v1.image.save');
        Route::get('user/all',['uses' => 'ImageController@getAllImageByUser'])->name('api.v1.image.all');
        Route::post('id',['uses' => 'ImageController@getImageById'])->name('api.v1.image.id');
});

Route::get('info',function(){
    return phpinfo();
});
