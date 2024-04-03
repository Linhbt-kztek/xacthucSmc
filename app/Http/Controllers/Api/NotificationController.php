<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Notification;
use App\Http\Models\Backend\User;
use JWTAuth;

class NotificationController extends Controller
{
    /*
     * danh sach thong bao api 
     */
    public function index($user_id)
    {
        try{
            $user = User::select('id')->where('user_id', $user_id)->first();
            $response["status"]  = 200;
            $response["message"] = "Danh sách thông báo";
            $rs = Notification::select('id','message','is_read');
            if($user) {
                $rs = $rs->where('user_id', $user->id);
            } else {
                $rs = $rs->where('type', Notification::PUSH_ALL)->distinct('user_id');
            }
            $response['data'] = $rs->orderBy('created_at', 'ASC')->get();
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
            $noti = Notification::find($id);
            if($noti) {
                $noti->is_read = 1;
                $noti->save();
            }
            $response["status"]  = 200;
            $response["message"] = "Chi tiết";
            $response['data'] = $noti;
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
    public function delete($ids)
    {
        $user = JWTAuth::parseToken()->authenticate();
        try{
            Notification::whereIn('id', explode(",", $ids))->delete();
            $response["status"]  = 200;
            $response["message"] = "Danh sách thông báo";
            $response['data'] = Notification::select('id','message','is_read')
                                            ->where('user_id', $user->id)
                                            ->orderBy('created_at', 'ASC')
                                            ->get();
        } catch(Exception $e) {
            $response["status"]  = 500;
            $response["message"] = "Internal Server Error";
            $response['data']    = [];
        }
        return response()->json($response);
    }
}
