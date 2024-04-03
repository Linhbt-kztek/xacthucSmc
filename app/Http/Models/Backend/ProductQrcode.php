<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductQrcode extends Model
{
    use SoftDeletes;
    protected $table = 'product_qrcode';
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    const PAGE_SIZE = 10;

    public function product() {
    	return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function company() {
    	return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
