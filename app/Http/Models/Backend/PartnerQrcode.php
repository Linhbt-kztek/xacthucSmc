<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerQrcode extends Model
{
    use SoftDeletes;
    protected $table = 'partner_qrcode';
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    const PAGE_SIZE = 10;
    
    public function partner() {
    	return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }
}
