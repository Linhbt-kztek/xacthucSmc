<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Backend\User;

class Warranty extends Model
{
	
    protected $table = 'warranty';
    public $timestamps = false;
    const PAGE_SIZE = 10;

   
}
