<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController as Controller;
use App\Http\Models\Frontend\Product;
use App\Http\Models\Frontend\Category;
use App\Http\Models\Frontend\News;
use App\Http\Models\Backend\Contact;
use App\Http\Models\Backend\Intro;
use App\Http\Models\Frontend\Setting;

class SiteController extends Controller
{
    public function index()
    {	
    	return redirect()->route('backend.site.index');
        /*$data = [];
        $data['meta_title'] = Setting::s(Setting::SEO, 'META_TITLE_SITE');
        $data['meta_keyword'] = Setting::s(Setting::SEO, 'META_KEYWORD_SITE');
        $data['meta_description'] = Setting::s(Setting::SEO, 'META_DESCRIPTION_SITE');*/
    	/*get product hot*/
    	/*$data['listProductHot'] = Product::where('status', Product::STATUS_ACTIVE)
    								->where('hot', Product::HOT_ACTIVE)
    								->orderBy('id', 'DESC')
    								->take(15)
    								->get();*/
        /*get product by category*/
        /*$data['listCategoryIndex'] = Category::with(['product' => function($q){
                                            $q->where('status', Product::STATUS_ACTIVE)
                                            ->orderBy('id', 'DESC');
                                            }])
                                            ->where('status', Category::STATUS_ACTIVE)
                                            ->orderBy('id', 'DESC')
                                            ->get();*/
    	/*return view("frontend.site.index", $data);*/
    }

    public function contact()
    {
    	$contact = Contact::where('status', Contact::STATUS_ACTIVE)
    				->orderBy('id', 'DESC')
    				->first();
    	return view('frontend.site.contact', ['contact'=>$contact]);
    }

    public function intro()
    {
    	$intro = Intro::where('status', Intro::STATUS_ACTIVE)
    				->orderBy('id', 'DESC')
    				->first();
    	return view('frontend.site.intro', ['intro'=>$intro]);
    }

    public function search(Request $request)
    {
        //$key = $this->convertStr($request->key);
        $key = $request->key;
        $arr_key = explode(" ", $key);
        //$rs_product = Product::where('status', Product::STATUS_ACTIVE);
        $rs_news = News::where('status', News::STATUS_ACTIVE);
        foreach ($arr_key as $item) {
            //$rs_product = $rs_product->whereRaw("(alias LIKE '%".$item."%' OR name LIKE CONCAT('%', CONVERT('".$item."', BINARY),'%'))");
            $rs_news = $rs_news->whereRaw("(alias LIKE '%".$item."%' OR name LIKE CONCAT('%', CONVERT('".$item."', BINARY),'%'))");
        }
        //$data["rs_products"] = $rs_product->orderBy('id', 'DESC')->paginate(Product::PAGE_SIZE);
        $data["rs_news"] = $rs_news->orderBy('id', 'DESC')->paginate(News::PAGE_SIZE);
        /* set active tab*/
        $data['tabnews'] = "";
        if ($request->has("tabnews")) {
            $data['tabnews'] = "active";
        }
        
        return view("frontend.site.search", $data);
    }

    public function error()
    {
        return view('frontend.site.error');
    }
}
