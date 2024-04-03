<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class \LangController extends Controller
{
    function switchLang($lang)
    {
    	if(in_array($lang, $languages)) {
    		Session::set('locale', $lang);
    	} else {
    		Session::set('locale', config('app.fallback_locale'));
    	}
    	return redirect()->back();
    }
}
