<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('login', [
	'as' 	=> 'api.login.pLogin',
	'uses'	=> 'LoginController@login'
]);

Route::post('register', [
	'as' 	=> 'api.login.pRegister',
	'uses'	=> 'LoginController@register'
]);

Route::post('checkPassword', [
	'as' 	=> 'api.login.pCheckPassword',
	'uses'	=> 'LoginController@checkPassword'
]);

/*NewsController*/
Route::get('dstintuc', [
	'as' 	=> 'api.news.index',
	'uses'	=> 'NewsController@index'
]);
Route::get('chitiettt/{id}', [
	'as' 	=> 'api.news.detail',
	'uses'	=> 'NewsController@detail'
]);
Route::get('timkiemtt/{title}', [
	'as' 	=> 'api.news.search',
	'uses'	=> 'NewsController@search'
]);

/*NotificationController*/
Route::get('notification-list/{user_id}', [
	'as' 	=> 'api.noti.index',
	'uses'	=> 'NotificationController@index'
]);
Route::get('notification-detail/{id}', [
	'as' 	=> 'api.noti.detail',
	'uses'	=> 'NotificationController@detail'
]);

/*HocphiController*/
Route::get('dsthongbaohocphi', [
	'as' 	=> 'api.hocphi.index',
	'uses'	=> 'HocphiController@index'
]);
Route::get('chitietthp/{id}', [
	'as' 	=> 'api.hocphi.detail',
	'uses'	=> 'HocphiController@detail'
]);
Route::post('tracuuhocphi', [
	'as' => 'api.hocphi.searchStudent',
	'uses' => 'HocphiController@searchStudent'
]);
Route::get('chitiettracuuhocphi/{idmsv}', [
	'as' 	=> 'api.hocphi.detailStudent',
	'uses'	=> 'HocphiController@detailStudent'
]);

/*LichthiController*/
Route::get('dsthongbaolichthi', [
	'as' 	=> 'api.lichthi.index',
	'uses'	=> 'LichthiController@index'
]);
Route::get('chitietlt/{id}', [
	'as' 	=> 'api.lichthi.detail',
	'uses'	=> 'LichthiController@detail'
]);
Route::post('tracuuthongbaolichthi', [
	'as' => 'api.lichthi.search',
	'uses' => 'LichthiController@search'
]);

/*TkbController*/
Route::get('dstkb', [
	'as' 	=> 'api.tkb.index',
	'uses'	=> 'TkbController@index'
]);
Route::get('chitiettkb/{id}', [
	'as' 	=> 'api.tkb.detail',
	'uses'	=> 'TkbController@detail'
]);
Route::post('tracuutkb', [
	'as' => 'api.tkb.search',
	'uses' => 'TkbController@search'
]);

/*SiteController*/
Route::get('lienhe', [
	'as' 	=> 'api.site.getContact',
	'uses'	=> 'SiteController@getContact'
]);
Route::get('fanpage', [
	'as' 	=> 'api.site.getFanpage',
	'uses'	=> 'SiteController@getFanpage'
]);
Route::get('bando', [
	'as' 	=> 'api.site.getMap',
	'uses'	=> 'SiteController@getMap'
]);
Route::get('videos', [
	'as' 	=> 'api.site.getVideos',
	'uses'	=> 'SiteController@getVideos'
]);
Route::get('daotaotructuyen', [
	'as' 	=> 'api.site.daotao',
	'uses'	=> 'SiteController@daotao'
]);
Route::get('dieukhoandichvu', [
	'as' 	=> 'api.site.dieukhoandichvu',
	'uses'	=> 'SiteController@getDieukhoandichvu'
]);
Route::get('chinhsachbaomat', [
	'as' 	=> 'api.site.chinhsachbaomat',
	'uses'	=> 'SiteController@getChinhsachbaomat'
]);

/*EventController*/
Route::get('dssukien', [
	'as' 	=> 'api.event.index',
	'uses'	=> 'EventController@index'
]);
Route::get('chitietsk/{id}', [
	'as' 	=> 'api.event.detail',
	'uses'	=> 'EventController@detail'
]);

/*DiemthiController*/
Route::get('dsdiemthi/{idmsv}', [
	'as' => 'api.diemthi.getListDiem',
	'uses' => 'DiemthiController@getListDiem'
]);

Route::post('tracuudiem', [
	'as' => 'api.diemthi.search',
	'uses' => 'DiemthiController@search'
]);

Route::post('suggestIdmsv', [
	'as' => 'api.diemthi.suggestIdmsv',
	'uses' => 'DiemthiController@suggestIdmsv'
]);

/*BangtotnghiepController*/
Route::post('tracuubangtotnghiep', [
	'as' => 'api.bangtotnghiep.search',
	'uses' => 'BangtotnghiepController@search'
]);

//Route::group(['middleware'=>'auth:api'],
Route::group(['middleware'=>'jwt.auth'],
	function(){
		/*LoginController*/
		Route::post('updateProfile', [
			'as' => 'api.login.updateProfile',
			'uses' => 'LoginController@updateProfile'
		]);

		Route::post('changePass', [
			'as' => 'api.login.changePass',
			'uses' => 'LoginController@changePass'
		]);

		Route::get('dsdiemdauvao', [
			'as' 	=> 'api.diemthi.indexDauvao',
			'uses'	=> 'DiemthiController@indexDauvao'
		]);
		Route::get('dsdiemchungchi', [
			'as' 	=> 'api.diemthi.indexChungchi',
			'uses'	=> 'DiemthiController@indexChungchi'
		]);
		Route::get('timkiemdauvao/{title}', [
			'as' 	=> 'api.diemthi.searchDauvao',
			'uses'	=> 'DiemthiController@searchDauvao'
		]);
		Route::get('timkiemchungchi/{title}', [
			'as' 	=> 'api.diemthi.searchChungchi',
			'uses'	=> 'DiemthiController@searchChungchi'
		]);
		Route::get('chitietdt/{id}', [
			'as' 	=> 'api.diemthi.detail',
			'uses'	=> 'DiemthiController@detail'
		]);
		Route::get('notification-delete/{ids}', [
			'as' 	=> 'api.noti.delete',
			'uses'	=> 'NotificationController@delete'
		]);
	}
);