<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class ActiveQrcode extends Model
{
    protected $table = 'active_qrcode';
    public $timestamps = true;

    const PAGE_SIZE = 10;

    public function product() {
    	return $this->belongsTo(Product::class, 'product_id');
    }

    public function company() {
    	return $this->belongsTo(Company::class, 'company_id');
    }

    public function partner() {
    	return $this->belongsTo(Partner::class, 'partner_id');
    }
}
