<?php

namespace App\Http\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    const STATUS_HIDE = 0;
    const STATUS_ACTIVE = 1;
    const NEW_HIDE = 0;
    const NEW_ACTIVE = 1;
    const HOT_HIDE = 0;
    const HOT_ACTIVE = 1;
    const PAGE_SIZE = 10;
}
