<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\News;

class TkbController extends Controller
{
    /*
     * dsthongbaohocphi api 
     */
    public function index()
    {
        try{
            $response["status"]  = 200;   
            $response["message"] = "Danh sách thời khóa biểu";            
            $response['data'] = News::select("id", "name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), 
                                 \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', attactfile) AS attactfile'),"introtext", "content")
                                ->where('status', News::STATUS_ACTIVE)
                                ->where('type', News::TYPE_TKB)
                                ->orderBy('created_at', 'DESC')
                                ->get();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }

    /*
     * chi tiet api 
     */
    public function detail($id)
    {
        try{
            $response["status"]  = 200;
            $response["message"] = "Chi tiết bài viết";
            $response['data'] = News::select("id", "name", 
                                \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'),
                                \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', attactfile) AS attactfile'), 
                                "introtext", "content", "updated_at")
                                ->where('id', $id)
                                ->first();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);
    }

    /*
     * search api 
     */
    public function search(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(), [
                            'idky' => 'required'        
                        ]);
            if ($validator->fails()) {
                $response["status"] = 422;
                $response["message"] = $validator->errors();
                $response["data"] = [];
                return response()->json($response, 422);
            }
            $response["status"]  = 200;   
            $response["message"] = "Kết quả tra cứu";            
            $response["data"] = News::select("id", "name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), 
                                 \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', attactfile) AS attactfile'),"introtext", "content")
                                ->where('status', News::STATUS_ACTIVE)
                                ->where('type', News::TYPE_TKB)
                                ->where('idky', $request->idky)
                                ->orderBy('created_at', 'DESC')
                                ->get();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }
}
