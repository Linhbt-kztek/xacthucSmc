<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Diemthi;
use App\Http\Models\Backend\News;

class DiemthiController extends Controller
{
    /*
     * danh sach diem api 
     */
    public function getListDiem(Request $request)
    {
        try{
            $response["status"]  = 200;
            $response["message"] = "Danh sách điểm thi theo IDMSV ".$request->idmsv;
            $response['data'] = Diemthi::select('idmsv','hodem','ten','ngaysinh',
                                'tenlop','tennganh','idmmh','tenmonhoc','dvht',
                                'diemtb1','diemtb2',\DB::raw('CONCAT(\''.\URL::to('/').'\', \'/anhthe/\', idmsv,\'.jpg\') AS introimage'))
                                ->where('idmsv', $request->idmsv)
                                ->orderBy('idky', 'ASC')
                                ->orderBy('tenmonhoc', 'ASC')
                                ->get();
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
            $response["status"]  = 200;   
            $response["message"] = "Kết quả tra cứu điểm thi";            
            $query = Diemthi::select('idmsv','hodem','ten','ngaysinh',
                    'tenlop',\DB::raw('CONCAT(\''.\URL::to('/').'\', \'/anhthe/\', idmsv,\'.jpg\') AS introimage'))->distinct();
            $keyword = str_replace("'", "\\'", $request->keyword);
            $check = preg_match('/[0-9]+/',$keyword);
            if ($check == 1) {
                $query = $query->where('idmsv', 'like','%'.$keyword.'%');
            } else {
                $query = $query->whereRaw("CONCAT(hodem,' ',ten) LIKE '%".$keyword."%'");
            }
            if($request->has('type')) {
                $query = $query->where('type', $request->type);
            }
            $response["data"] = $query->orderBy('idky', 'ASC')
                                ->orderBy('tenmonhoc', 'ASC')
                                ->get();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }


    /*
     * ds thong bao diem dau vao api 
     */
    public function indexDauvao()
    {
        try{
            $response["status"]  = 200;   
            $response["message"] = "Danh sách điểm đầu vào";            
            $response['data'] = News::select("id", "name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), 
                                 \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', attactfile) AS attactfile'),"introtext", "content")
                                ->where('status', News::STATUS_ACTIVE)
                                ->where('type', News::TYPE_DIEMDAUVAO)
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
     * ds thong bao diem chung chi api 
     */
    public function indexChungchi()
    {
        try{
            $response["status"]  = 200;   
            $response["message"] = "Danh sách điểm thi chứng chỉ B1";            
            $response['data'] = News::select("id", "name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), 
                                 \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', attactfile) AS attactfile'),"introtext", "content")
                                ->where('status', News::STATUS_ACTIVE)
                                ->where('type', News::TYPE_DIEMCHUNGCHI)
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
            $response["message"] = "Chi tiết";
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
     * searchDauvao api 
     */
    public function searchDauvao($title)
    {
        try{
            $response["status"]  = 200;   
            $response["message"] = "Kết quả tìm kiếm điểm thi đầu vào hệ thạc sỹ";            
            $response["data"] = News::select("id", "name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), 
                                 \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', attactfile) AS attactfile'),"introtext", "content")
                                ->where('status', News::STATUS_ACTIVE)
                                ->where('type', News::TYPE_DIEMDAUVAO)
                                ->where('news.name', 'like', '%'.$title.'%')
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
     * searchDauvao api 
     */
    public function searchChungchi($title)
    {
        try{
            $response["status"]  = 200;   
            $response["message"] = "Kết quả tìm kiếm điểm thi chứng chỉ B1";            
            $response["data"] = News::select("id", "name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), 
                                 \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', attactfile) AS attactfile'),"introtext", "content")
                                ->where('status', News::STATUS_ACTIVE)
                                ->where('type', News::TYPE_DIEMCHUNGCHI)
                                ->where('news.name', 'like', '%'.$title.'%')
                                ->orderBy('created_at', 'DESC')
                                ->get();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }

    public function suggestIdmsv(Request $request) {
        $keyword = str_replace("'", "\\'", $request->idmsv);
        $check = preg_match('/[0-9]+/',$keyword);
        if($request->type == 3) {
            $rs = \DB::table('bangtotnghiep')->select('*');
            if ($check == 1) {
                $rs = $rs->where('sohieuvb', 'like', '%'.$keyword.'%');
            } else {
                $rs = $rs->where('hoten', 'like', '%'.$keyword.'%');
            }
        } else {
            $rs = Diemthi::select('*')
                         ->distinct('idmsv')
                         ->where('type', $request->type);
            
            if ($check == 1) {
                $rs = $rs->where('idmsv', 'like', '%'.$keyword.'%');
            } else {
                $rs = $rs->whereRaw("CONCAT(hodem,' ',ten) LIKE '%".$keyword."%'");
            }
        }
        $rs = $rs->take(5)->get();
        $response["status"]  = 200;
        $response["message"] = "Search results";
        $response['data']    = $rs;
        return response()->json($response);
    }

}
