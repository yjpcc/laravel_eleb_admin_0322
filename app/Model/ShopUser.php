<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopUser extends Model
{
    protected $fillable=['name','email','password','shop_id','status'];

    public function shop(){
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }
}
