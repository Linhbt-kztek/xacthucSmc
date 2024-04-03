<?php

namespace App\Http\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'setting';

    public $timestamps = true;

    const INFORMATION = 1;
    const SEO = 2;

    static $TYPE = [
        self::INFORMATION => "Liên hệ",
        self::SEO => "SEO"
    ];

    static function s($type, $value) {
        $rs = self::select("content")
                ->where("language", \Lang::getLocale())
                ->where('name', $value)
                ->where('type', $type)
                ->first();
        if($rs) {
            return $rs->content;
        } else {
            return "";
        }
    }
}
