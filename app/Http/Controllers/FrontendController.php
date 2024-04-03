<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Models\Frontend\Menu;
use App\Http\Models\Frontend\Category;
use App\Http\Models\Frontend\News;
use App\Http\Models\Frontend\Product;
use App\Http\Models\Backend\AdsLink;
use App\Http\Models\Frontend\Setting;
use Config;

class FrontendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    	/* get menu */
        $menu = Menu::where('status', Menu::STATUS_ACTIVE)
                    ->where('parent_id', 0)
                    ->orderBy('order_view', 'ASC')
                    ->get();
        $data['menu'] = Menu::createMenu($menu);
        /* get cat_news */
        $data['cat_news'] = Category::with('news')
                            ->where('type', Category::TYPE_NEWS)
                            ->where('status', Category::STATUS_ACTIVE)
                            ->orderBy('id', 'DESC')
                            ->get();
    	/* get news hot */
    	$data['newsHot'] = News::where('status', News::STATUS_ACTIVE)
    						->where('hot', News::HOT_ACTIVE)
    						->orderBy('id', 'DESC')
    						->take(3)
    						->get();
		/* get news new */
    	$data['newsNew'] = News::where('status', News::STATUS_ACTIVE)
    						->where('new', News::NEW_ACTIVE)
    						->orderBy('id', 'DESC')
    						->take(5)
    						->get();
        /* get setting */
        $data['setting']['site_name'] = Setting::s(Setting::INFORMATION, 'SITE_NAME');
        $data['setting']['address'] = Setting::s(Setting::INFORMATION, 'SITE_ADDRESS');
        $data['setting']['phone'] = Setting::s(Setting::INFORMATION, 'SITE_PHONE');
        $data['setting']['skype'] = Setting::s(Setting::INFORMATION, 'SITE_SKYPE');
        $data['setting']['email'] = Setting::s(Setting::INFORMATION, 'SITE_EMAIL');
        $data['setting']['website'] = Setting::s(Setting::INFORMATION, 'SITE_URL');
        $data['setting']['fbFanpage'] = Setting::s(Setting::INFORMATION, 'FB_FANPAGE');
        $data['setting']['googleId'] = Setting::s(Setting::SEO, 'GOOGLE_ID');
        $data['setting']['copyright'] = Setting::s(Setting::INFORMATION, 'SITE_COPYRIGHT');                                                                                                
        \View::share('dataShare', $data);
    }

    public function convertStr($str) 
    {
    // In thường
         $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
         $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
         $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
         $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
         $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
         $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
         $str = preg_replace("/(đ)/", 'd', $str);    
    // In đậm
         $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
         $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
         $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
         $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
         $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
         $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
         $str = preg_replace("/(Đ)/", 'D', $str);
         return $str; // Trả về chuỗi đã chuyển
    } 

}
