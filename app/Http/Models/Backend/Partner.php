<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;
    protected $table = 'partner';
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    const PAGE_SIZE = 10;

    public function company() {
    	return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public static function getListDropdown($company_id) {
    	return self::select('id','name as text')->where('company_id', $company_id)->orderBy('name', 'ASC')->get();
    }
}
