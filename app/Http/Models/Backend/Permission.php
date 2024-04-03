<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permission';
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $timestamps = false;
}
