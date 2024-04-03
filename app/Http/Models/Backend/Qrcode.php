<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qrcode extends Model
{
    use SoftDeletes;
    protected $table = 'qrcode';
    protected $primaryKey = 'guid';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    const PAGE_SIZE = 15;
    const TYPE_OLD = 1;
    const TYPE_NEW = 2;

    private static $salt = [
        'l2',
        'x8',
        'n4',
        'k9',
        'o7',
        'p1',
        'y3',
        'z0',
        'a5',
        'c6'
    ];
    const PRE_TEXT = '@xtsmc';

    public static function getGUID() {
        if (function_exists('com_create_guid')){
            return strtolower(trim(com_create_guid(), '{}'));
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
            return strtolower(trim($uuid, '{}'));
        }
    }

    public static function checkStart($company_id, $start, $type = '') {
        $qrcode = Qrcode::select(\DB::raw('MAX(`end`) as end'))
                          ->where('company_id', $company_id)
                          ->first();
        if($type != '') {
            if($qrcode && $qrcode->end >= $start) {
                return ($qrcode->end + 1);
            }
            return 1;
        } else {
            if($qrcode && ($qrcode->end+1) != $start) {
                return 'Serial đầu nên bắt đầu từ '.($qrcode->end + 1);
            }
            return '';
        }
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public static function encodeSerial($serial) {
        $arr_serial = str_split($serial*13+27);
        $salt = self::$salt;
        $hash = '';
        foreach ($arr_serial as $val) {
            $hash .= $salt[$val];
        }
        return $hash;
    }

    public static function decodeSerial($hash_serial) {
        $arr_hash_serial = str_split($hash_serial, 2);
        $salt = self::$salt;
        $serial = '';
        foreach ($arr_hash_serial as $val) {
            $serial .= array_search($val, $salt);
        }
        return (((int) $serial)-27)/13;
    }
}
