<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController as Controller;
use App\Http\Models\Frontend\News;
use App\Http\Models\Frontend\Category;
use App\Http\Models\Frontend\Setting;

class NewsController extends Controller
{
    public function index()
    {
        $data['meta_title'] = Setting::s(Setting::SEO, 'META_TITLE_NEWS');
        $data['meta_keyword'] = Setting::s(Setting::SEO, 'META_KEYWORD_NEWS');
        $data['meta_description'] = Setting::s(Setting::SEO, 'META_DESCRIPTION_NEWS');

    	$data['listNews'] = News::where('status', News::STATUS_ACTIVE)
    							->orderBy('id', 'DESC')
    							->paginate(News::PAGE_SIZE);
		return view('frontend.news.index', $data);
    }

    public function listByCategory($alias)
    {
        $data['cat'] = Category::where('alias', $alias)->first();
        if(count($data['cat']) > 0) {
            $data['listByCat'] = News::where('status', News::STATUS_ACTIVE)
                                    ->where('cat_id', $data['cat']->id)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(News::PAGE_SIZE);
            return view('frontend.news.listByCategory', $data);
        } else {
            return redirect()->route('frontend.site.error');
        }
    }

    public function detail($alias)
    {
    	$data['news'] = News::where('alias', $alias)->first();
    	if(count($data['news']) > 0) {
	    	$data['suggestNews'] = News::where('status', News::STATUS_ACTIVE)
	    							->where('cat_id', $data['news']->cat_id)
	    							->where('id', '<>', $data['news']->id)
	    							->paginate(9);
			return view('frontend.news.detail', $data);
    	} else {
    		return redirect()->route('frontend.site.error');
    	}
    }
}
