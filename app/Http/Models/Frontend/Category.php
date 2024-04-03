<?php

namespace App\Http\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    const STATUS_HIDE = 0;
    const STATUS_ACTIVE = 1;
    const TYPE_PRODUCT = 1;
    const TYPE_NEWS = 2;
    const PAGE_SIZE = 10;

    public function child() {
        return $this->hasMany('App\Http\Models\Frontend\Category', 'parent_id', 'id');
    }

    public function news() {
        return $this->hasMany('App\Http\Models\Frontend\News', 'cat_id', 'id');
    }
}
