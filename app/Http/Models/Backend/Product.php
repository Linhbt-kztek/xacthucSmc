<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'product';
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    const PAGE_SIZE = 10;
    public function company() {
    	return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function product_image() {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public static function getListDropdown() {
		return self::select('id','name as text')->orderBy('id', 'DESC')->get();
    }
}
