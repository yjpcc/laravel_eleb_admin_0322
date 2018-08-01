<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable=['username','password','tel','members_img','status'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
