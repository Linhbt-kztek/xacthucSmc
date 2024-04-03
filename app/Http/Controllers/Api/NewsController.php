<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\News;

class NewsController extends Controller
{
    public function index()
    {
        try{
            $response["status"]  = 200;
            $response["message"] = "Danh sách tin tức";
            $response['data'] = News::select("id", "name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), "introtext")
                                    ->where('status', News::STATUS_ACTIVE)
                                    ->where('type', News::TYPE_NEWS)
                                    ->orderBy('created_at', 'DESC')
                                    ->get();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
		return response()->json($response);   
    }

    public function detail($id)
    {
    	try{
            $response["status"]  = 200;
            $response["message"] = "Chi tiết tin tức";
            $response['data'] = News::select("id", "name", 
                                \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), 
                                "introtext", "content")
                                ->where('id', $id)
                                ->first();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);
    }

    public function search($title)
    {
        try{
            $response["status"]  = 200;
            $response["message"] = "Kết quả tìm kiếm";
            $response['data'] = News::select("news.id", "news.name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', tbl_news.introimage) AS introimage'), "news.introtext", "news.cat_id", "category.name as cat_name")
                                    ->join('category','category.id','=','news.cat_id')
                                    ->where('news.status', News::STATUS_ACTIVE)
                                    ->where('news.type', News::TYPE_NEWS)
                                    ->where('news.name', 'like', '%'.$title.'%')
                                    ->orderBy('news.created_at', 'DESC')
                                    ->get();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }
}
