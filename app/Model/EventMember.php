<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
    protected $fillable=['events_id','member_id'];

    public function shop(){
        return $this->belongsTo(ShopUser::class,'member_id');
    }

//    public function event(){
//        return $this->belongsTo(Event::class,'id');
//    }

    public function event(){
        return $this->belongsTo(Event::class,'events_id');
    }
}
