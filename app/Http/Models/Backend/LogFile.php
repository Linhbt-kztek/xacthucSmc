<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class LogFile extends Model
{
    protected $table = 'log_file';

    public $timestamps = true;

    const TYPE_DIEMTHI = 'diemthi';
    const TYPE_SINHVIEN = 'sinhvien';
    const TYPE_HOCPHI = 'hocphi';
    const TYPE_LICHTHI = 'lichthi';
    const TYPE_TKB = 'thoikhoabieu';

    public static function insertIgnore($data, $table){
       $query = 'INSERT INTO '.$table.' ('.implode(',',array_keys($data[0])).') VALUES ';
       $comma = "";
       foreach ($data as $key=>$item) {
            if($key > 0) $comma = ",";
            $query .= $comma."('".implode("', '", array_values($item))."')";
       }
       $query .= " ON DUPLICATE KEY UPDATE `duplicate`='1'";
       \DB::statement($query);
	}
}
