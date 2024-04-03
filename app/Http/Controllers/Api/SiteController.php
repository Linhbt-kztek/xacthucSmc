<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Setting;
use App\Http\Models\Backend\Contact;
use App\Http\Models\Backend\Video;

class SiteController extends Controller
{
    /*
     * lien he
     */
    public function getContact()
    {
        try{
            $contact = Contact::where('status', Contact::STATUS_ACTIVE)
                        ->where('language', config('app.locale_admin'))
                        ->orderBy('id', 'DESC')->first();
            if($contact) {
                $response["status"]  = 200;
                $response["message"] = "Thông tin liên hệ";
                $response['data'] = $contact->content;
            } else {
                $response["status"]  = 404;
                $response["message"] = "Not found data";
                $response['data'] = [];
            }
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }

    /*
     * fanpage api 
     */
    public function getFanpage()
    {
        try{
            $setting = Setting::select("content")
                        ->where("language", config('app.locale_admin'))
                        ->where('name', 'FB_FANPAGE')
                        ->where('type', Setting::INFORMATION)
                        ->first();
            if($setting) {
                $response["status"]  = 200;
                $response["message"] = "Link Fanpage";
                $response['data'] = $setting->content;
            } else {
                $response["status"]  = 404;
                $response["message"] = "Not found data";
                $response['data'] = [];
            }
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }
    /*
     * map api 
     */
    public function getMap()
    {
        try{
            $setting = Setting::select("content")
                        ->where("language", config('app.locale_admin'))
                        ->where('name', 'GOOGLE_MAP')
                        ->where('type', Setting::INFORMATION)
                        ->first();
            if($setting) {
                $response["status"]  = 200;
                $response["message"] = "Bản đồ";
                $response['data'] = $setting->content;
            } else {
                $response["status"]  = 404;
                $response["message"] = "Not found data";
                $response['data'] = [];
            }
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);   
    }

    /*
     * video api 
     */
    public function getVideos()
    {
        try{
            $videos = Video::select("name", "description", "url")
                        ->where("language", config('app.locale_admin'))
                        ->where("type", Video::TYPE_VIDEO)
                        ->orderBy("created_at", "DESC")
                        ->get();
            if($videos) {
                $response["status"]  = 200;
                $response["message"] = "Danh sách video";
                $response['data'] = $videos;
            } else {
                $response["status"]  = 404;
                $response["message"] = "Not found data";
                $response['data'] = [];
            }
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);
    }

    /*
     * dieukhoandichvu api 
     */
    public function getDieukhoandichvu()
    {
        return view('backend.site.dieukhoandichvu');
    }

    /*
     * chinhsachbaomat api 
     */
    public function getChinhsachbaomat()
    {
        return view('backend.site.chinhsachbaomat');
    }

    /*
     * video dao tao api 
     */
    public function daotao()
    {
        try{
            $videos = Video::select("video.name", "video.introimage", "video.description", "video.youtube_id", "video.created_at",
                        "category.id as cat_id","category.name as cat_name")
                        ->join("category","category.id","=","video.cat_id")
                        ->where("video.language", config('app.locale_admin'))
                        ->where("video.type", Video::TYPE_YOUTUBE)
                        ->where("video.status", Video::STATUS_ACTIVE)
                        ->orderBy("video.created_at", "DESC")
                        ->get();
            if($videos) {
                $response["status"]  = 200;
                $response["message"] = "Danh sách video";
                $response['data'] = $videos;
            } else {
                $response["status"]  = 404;
                $response["message"] = "Not found data";
                $response['data'] = [];
            }
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);
    }
}
