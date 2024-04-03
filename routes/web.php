<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*SITE*/
/*Route::get('/', [
	'as' => 'frontend.site.index',
	'uses'  => 'SiteController@index'
	]);*/
Route::get('/', function() {
	return redirect()->route('backend.site.index');
});
Route::get('/tim-kiem.html', [
	'as' => 'frontend.site.search',
	'uses'  => 'SiteController@search'
	]);
Route::get('/lien-he.html', [
	'as' => 'frontend.site.contact',
	'uses'  => 'SiteController@contact'
	]);
Route::get('/gioi-thieu.html', [
	'as' => 'frontend.site.intro',
	'uses'  => 'SiteController@intro'
	]);
Route::get('/error.html', [
	'as' => 'frontend.site.error',
	'uses'  => 'SiteController@error'
	]);

/*NEWS*/
Route::get('/tin-tuc.html', [
	'as' => 'frontend.news.index',
	'uses'  => 'NewsController@index'
	]);
Route::get('/dmtt-{alias}', [
	'as' => 'frontend.news.listByCategory',
	'uses'  => 'NewsController@listByCategory'
	]);
Route::get('/tt-{alias}', [
	'as' => 'frontend.news.detail',
	'uses'  => 'NewsController@detail'
	]);
	
	Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
	