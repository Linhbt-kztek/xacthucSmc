<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Event;
use App\Http\Models\Backend\News;

class EventController extends Controller
{
    public function index()
    {
        try{
            $response["status"]  = 200;
            $response["message"] = "Danh sách sự kiện";
            $response['data'] = Event::select("id", "name", \DB::raw('CONCAT(\''.\URL::to('/').'\', \'/\', introimage) AS introimage'), "introtext")
                                    ->where('status', News::STATUS_ACTIVE)
                                    ->where('type', News::TYPE_EVENT)
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
            $response["message"] = "Chi tiết sự kiện";
            $response['data'] = Event::select("id", "name", 
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
}
