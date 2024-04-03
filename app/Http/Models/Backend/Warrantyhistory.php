<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Backend\User;

class Warrantyhistory extends Model
{
	
    protected $table = 'warrantyhistory';
    public $timestamps = false;
    const PAGE_SIZE = 20;

   
}
