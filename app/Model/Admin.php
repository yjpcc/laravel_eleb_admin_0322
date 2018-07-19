<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','icon'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
