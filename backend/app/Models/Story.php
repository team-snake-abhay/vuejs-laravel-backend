<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany('App\Models\StoryComment','story_id','id');
    }

    public function audio()
    {
        return $this->hasOne('App\Models\MediaStore','id','audio_id')->where('media_type','audio');
    }
}
