<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        //one role belongs to many user, maching table user_role,
        //role_id is the foreign key from this table
        //user_id is the foreign key form user table in maching table
        return $this->belongsToMany('App\Models\User', 'user_roles', 'role_id', 'user_id');
    }
}
