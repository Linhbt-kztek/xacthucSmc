<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Hocphi;
use App\Http\Models\Backend\News;

class HocphiController extends Controller
{
    /*
     * dsthongbaohocphi api 
     */
    public function index()
    {
        try{
            $response["status"]  = 200;   
            $response["message"] = "Danh sách thông báo học phí";            
            $response['data'] = News::select("id", "name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), 
                                 \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', attactfile) AS attactfile'),"introtext", "content", "idky AS cat_id",
                                 \DB::raw('
                                    CASE WHEN idky=\'CH\' THEN \'Cao học\'
                                    WHEN idky=\'DH\' THEN \'Đại học\'
                                    WHEN idky=\'LT\' THEN \'Liên thông\'
                                    WHEN idky=\'VB2\' THEN \'Văn bằng II\'
                                    END AS cat_name
                                    ')
                                )
                                ->where('status', News::STATUS_ACTIVE)
                                ->where('type', News::TYPE_HOCPHI)
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
     * searchStudent api 
     */
    public function searchStudent(Request $request)
    {
        try{
            $response["status"]  = 200;   
            $response["message"] = "Kết quả tra cứu học phí";            
            $query = Hocphi::select('idmsv','hodem','ten');
            $keyword = str_replace("'", "\\'", $request->keyword);
            if(is_numeric($keyword)) {
                $query = $query->where('idmsv', $keyword);
            } else {
                $query = $query->where('hodem', 'like', '%'.$keyword.'%')
                               ->orWhere('ten', 'like', '%'.$keyword.'%');
            }
            $response["data"] = $query->orderBy('created_at', 'ASC')
                                ->orderBy('idmsv', 'ASC')
                                ->get();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }

    /*
     * detailStudent api 
     */
    public function detailStudent(Request $request)
    {
        try{
            $response["status"]  = 200;   
            $response["message"] = "Kết quả tra cứu học phí theo IDMSV ".$request->idmsv;            
            $query = Hocphi::select('idmsv','hodem','ten','tienmat_k1','chuyenkhoan_k1','ngaythu_k1','tienmat_k2','chuyenkhoan_k2','ngaythu_k2','tienmat_k3', 'chuyenkhoan_k3', 'ngaythu_k3', 'tienmat_b1', 'chuyenkhoan_b1', 'ngaythu_b1')
                    ->where('idmsv', $request->idmsv);
            $response["data"] = $query->orderBy('created_at', 'ASC')
                                ->orderBy('idmsv', 'ASC')
                                ->get();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }
}
