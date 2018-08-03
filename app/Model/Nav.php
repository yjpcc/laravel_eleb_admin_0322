<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class Nav extends Model
{
    protected $fillable=['name','url','pid','permission_id'];

    public function children(){
        return $this->hasMany(self::class,'pid');
    }

    public function permission(){
        return $this->belongsTo(Permission::class);
    }

    public static function navHtml(){
        $html='';
        foreach(self::where('pid',0)->get() as $nav){
            $childHtml='';
            foreach($nav->children as $row){
                if(Auth::user()->can($row->permission->name))
                $childHtml.='<li><a href="'.route( $row->url ).'">'.$row->name.'</a></li>';
            }
            if(empty($childHtml)){
                continue;
            }
            $html.='<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav->name.'<span class="caret"></span></a>
                     <ul class="dropdown-menu">';
             $html.=$childHtml;
             $html.='</ul>
                </li>';
        }
        return $html;
    }
}
