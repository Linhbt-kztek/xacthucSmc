<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    public $timestamps = true;

    const STATUS_ACTIVE = 1;
    const STATUS_HIDE = 2;
    const PAGE_SIZE = 10;
}
