<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    const PAGE_SIZE = 10;
}
