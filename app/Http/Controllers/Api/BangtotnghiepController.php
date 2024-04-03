<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class BangtotnghiepController extends Controller
{
    /*
     * search api 
     */
    public function search(Request $request)
    {
        try{
            $response["status"]  = 200;   
            $response["message"] = "Kết quả tra cứu bằng tốt nghiệp";   
            $keyword = str_replace("'", "\\'", $request->keyword);
            $check = preg_match('/[0-9]+/',$keyword);
            $rs = \DB::table('bangtotnghiep')->select('*');
            if ($check == 1) {
                $rs = $rs->where('sohieuvb', 'like', '%'.$keyword.'%');
            } else {
                $rs = $rs->where('hoten', 'like', '%'.$keyword.'%');
            }
            $rs = $rs->get();
            $response['data'] = $rs;
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }

}
