<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{

    protected $fillable=['name','type_accumlation','shop_id','des','is_selected'];
}
