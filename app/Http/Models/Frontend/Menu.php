<?php

namespace App\Http\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'menu';

    const STATUS_HIDE = 0;
    const STATUS_ACTIVE = 1;

    public function child() 
    {
        return $this->hasMany('App\Http\Models\Frontend\Menu', 'parent_id', 'id');
    }

    static function createMenu($data) 
    {
    	$menu = '';
    	foreach ($data as $key => $item) {
    		$menu .= '<td class ="headlink">';
    		if($key == 0) {
    			$menu .= '<a class ="" href ="'.$item->url.'" title="'.$item->name.'"><img src="'.asset('frontend/images/bd/iconmenu.png').'" style="margin:-5px 5px 0;vertical-align:middle;width:22px" /></a>';
    		} else {
    			$menu .= '<a class ="" href ="'.$item->url.'" title="'.$item->name.'">'.$item->name.'</a>';
    		}
	    	
	    	$rs = self::with('child')->find($item->id);
	        if(count($rs->child) > 0) {
	        	$menu .= self::createChildItem($rs->child, 0);
	        }

    		$menu .= '</td>';
	    }
	    return $menu;
    }

    static function createChildItem($data, $level = 0)
    {
    	$_class_ul = "";
    	$_class_li = "";
    	if($level == 0) {
    		$_class_ul = 'class="ultop2"';
    		$_class_li = 'class="list"';
    	}
		$menu = '<ul '.$_class_ul.'>';
    	foreach ($data as $key => $item) {
    		$menu .= '<li '.$_class_li.'>';
    		$menu .= '<a href="'.$item->url.'" title="'.$item->name.'"><img class="ig" src="'.asset('frontend/images/menu/null.gif').'" alt="">'.$item->name.'</a>';
    		$rs = self::with('child')->find($item->id);
	        if(count($rs->child) > 0) {
	        	$menu .= self::createChildItem($rs->child, $level+1);
	        }
    		$menu .= '</li>';
    	}
    	$menu .= '</ul>';
    	return $menu;
    }
}
