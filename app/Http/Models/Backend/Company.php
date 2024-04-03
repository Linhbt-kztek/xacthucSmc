<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Backend\User;

class Company extends Model
{
	use SoftDeletes;
    protected $table = 'company';
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    const PAGE_SIZE = 10;

    public static function getListDropdown() {
    	if (auth()->user()->is_admin == User::IS_ADMIN) {
    		return self::select('id','name')->orderBy('id', 'DESC')->get();
    	} else {
    		return self::select('id','name')->where('asign_to', auth()->user()->id)->orderBy('id', 'DESC')->get();
    	}
    }

    public static function getListIdsByAuth() {
    	return self::where('asign_to', auth()->user()->id)->pluck('id')->toArray();
    }
}
