<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryComment extends Model
{
    use HasFactory;

    public function story()
    {
        return $this->belongsTo(Story::class,'story_id','id');
    }
}
