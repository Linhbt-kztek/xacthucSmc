<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'role_permission';
    public $timestamps = false;
    protected $primaryKey = ['role_id', 'permission'];
    public $incrementing = false;
}
