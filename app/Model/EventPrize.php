<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{

    protected $fillable=['events_id','name','description','member_id'];

    public function event(){
        return $this->belongsTo(Event::class,'events_id','id');
    }

    public function member(){
        return $this->belongsTo(ShopUser::class,'member_id','id');
    }
}
