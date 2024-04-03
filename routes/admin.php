<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'guest'],
	function() {
		Route::get('/', [
			'as' => 'backend.site.vLogin',
			'uses'  => 'SiteController@login'
			]);

		Route::get('/login', [
			'as' => 'backend.site.vLogin',
			'uses'  => 'SiteController@login'
			]);

		Route::post('/login', [
			'as' => 'backend.site.pLogin',
			'uses'  => 'SiteController@login'
			]);

		Route::get('resetPass', [
			'as' => 'backend.site.vResetPass',
			'uses'  => 'SiteController@resetPass'
			]);
		Route::post('resetPass', [
			'as' => 'backend.site.pResetPass',
			'uses'  => 'SiteController@resetPass'
			]);
	}
);


Route::group(['middleware'=>['auth', 'roles']],
	function() {
		/*SiteController*/
		Route::get('/home', [
			'as' => 'backend.site.index',
			'uses'  => 'SiteController@index',
			//'roles' => ['backend.site.index']
			'roles' => [1,2]
			]);
		Route::get('/logout', [
			'as' => 'backend.site.logout',
			'uses'  => 'SiteController@logout',
			//'roles' => ['backend.site.logout']
			'roles' => [1,2]
			]);
		Route::get('/site/error/{errorCode}-{msg}', [
			'as' => 'backend.site.error',
			'uses'  => 'SiteController@error',
			//'roles' => ['backend.site.error']
			'roles' => [1,2]
			]);
		Route::post('site/uploadImageContent', [
			'as' => 'backend.site.uploadImageContent',
			'uses'  => 'SiteController@uploadImageContent',
			//'roles' => ['backend.site.uploadImageContent']
			'roles' => [1,2]
			]);
  
      	/*warrantyController*/
		Route::get('warranty/index', [
			'as' => 'backend.warranty.index',
			'uses'  => 'WarrantyController@index',
			//'roles' => ['backend.company.index']
			'roles' => [1,2]
			]);
			
		Route::get('warranty/history/{id}', [
			'as' => 'backend.warranty.history',
			'uses'  => 'WarrantyController@history',
			'roles' => [1,2]
			]);	
		Route::get('warranty/viewadd', [
			'as' => 'backend.warranty.viewadd',
			'uses'  => 'WarrantyController@viewadd',
			//'roles' => ['backend.company.pAdd']
			'roles' => [1,2]
			]);	
        	
        
   	Route::post('warranty/history/{id}', [
			'as' => 'backend.warranty.pEdit',
			'uses'  => 'WarrantyController@edit',
			//'roles' => ['backend.user.pEdit']
			'roles' => [1,2]
			]);
   
			
			
		Route::post('warranty/addhistory', [
			'as' => 'backend.warranty.addhistory',
			'uses'  => 'WarrantyController@addhistory',
			//'roles' => ['backend.company.pAdd']
			'roles' => [1,2]
			]);	
       
        Route::get('warranty/delhistory/{id}', [
			'as' => 'backend.warranty.delhistory',
			'uses'  => 'WarrantyController@delhistory',
			//'roles' => ['backend.user.delete']
			'roles' => [1,2]
			]);

       	Route::get('warranty/downloadExcel', [
			'as' => 'backend.warranty.downloadExcel',
			'uses'  => 'WarrantyController@downloadExcel',
			//'roles' => ['backend.company.pAdd']
			'roles' => [1,2]
			]);	
		
		
        
		/*CompanyController*/
		Route::get('company/index', [
			'as' => 'backend.company.index',
			'uses'  => 'CompanyController@index',
			//'roles' => ['backend.company.index']
			'roles' => [1,2]
			]);
		Route::get('company/add', [
			'as' => 'backend.company.vAdd',
			'uses'  => 'CompanyController@add',
			//'roles' => ['backend.company.vAdd']
			'roles' => [1]
			]);
		Route::post('company/add', [
			'as' => 'backend.company.pAdd',
			'uses'  => 'CompanyController@add',
			//'roles' => ['backend.company.pAdd']
			'roles' => [1]
			]);
		Route::get('company/edit/{id}', [
			'as' => 'backend.company.vEdit',
			'uses'  => 'CompanyController@edit',
			//'roles' => ['backend.company.vEdit']
			'roles' => [1,2]
			]);
		Route::post('company/edit/{id}', [
			'as' => 'backend.company.pEdit',
			'uses'  => 'CompanyController@edit',
			//'roles' => ['backend.company.pEdit']
			'roles' => [1,2]
			]);
		Route::get('company/delete/{id}', [
			'as' => 'backend.company.delete',
			'uses'  => 'CompanyController@delete',
			//'roles' => ['backend.company.delete']
			'roles' => [1]
			]);

		/*PartnerController*/
		Route::get('partner/index', [
			'as' => 'backend.partner.index',
			'uses'  => 'PartnerController@index',
			//'roles' => ['backend.partner.index']
			'roles' => [1,2]
			]);
		Route::get('partner/add', [
			'as' => 'backend.partner.vAdd',
			'uses'  => 'PartnerController@add',
			//'roles' => ['backend.partner.vAdd']
			'roles' => [1,2]
			]);
		Route::post('partner/add', [
			'as' => 'backend.partner.pAdd',
			'uses'  => 'PartnerController@add',
			//'roles' => ['backend.partner.pAdd']
			'roles' => [1,2]
			]);
		Route::get('partner/edit/{id}', [
			'as' => 'backend.partner.vEdit',
			'uses'  => 'PartnerController@edit',
			//'roles' => ['backend.partner.vEdit']
			'roles' => [1,2]
			]);
		Route::post('partner/edit/{id}', [
			'as' => 'backend.partner.pEdit',
			'uses'  => 'PartnerController@edit',
			//'roles' => ['backend.partner.pEdit']
			'roles' => [1,2]
			]);
		Route::get('partner/delete/{id}', [
			'as' => 'backend.partner.delete',
			'uses'  => 'PartnerController@delete',
			//'roles' => ['backend.partner.delete']
			'roles' => [1,2]
			]);

		/*ProductController*/
		Route::get('product/index', [
			'as' => 'backend.product.index',
			'uses'  => 'ProductController@index',
			//'roles' => ['backend.news.index']
			'roles' => [1,2]
			]);
		Route::get('product/add', [
			'as' => 'backend.product.vAdd',
			'uses'  => 'ProductController@add',
			//'roles' => ['backend.news.vAdd']
			'roles' => [1,2]
			]);
		Route::post('product/add', [
			'as' => 'backend.product.pAdd',
			'uses'  => 'ProductController@add',
			//'roles' => ['backend.news.pAdd']
			'roles' => [1,2]
			]);
		Route::get('product/edit/{id}', [
			'as' => 'backend.product.vEdit',
			'uses'  => 'ProductController@edit',
			//'roles' => ['backend.news.vEdit']
			'roles' => [1,2]
			]);
		Route::get('product/copy/{id}', [
			'as' => 'backend.product.copy',
			'uses'  => 'ProductController@copy',
			//'roles' => ['backend.news.vEdit']
			'roles' => [1,2]
			]);
		Route::post('product/edit/{id}', [
			'as' => 'backend.product.pEdit',
			'uses'  => 'ProductController@edit',
			//'roles' => ['backend.news.pEdit']
			'roles' => [1,2]
			]);
		Route::get('product/delete/{id}', [
			'as' => 'backend.product.delete',
			'uses'  => 'ProductController@delete',
			//'roles' => ['backend.news.delete']
			'roles' => [1,2]
			]);
		Route::post('product/reverseHot', [
			'as' => 'backend.product.reverseHot',
			'uses'  => 'ProductController@reverseHot',
			//'roles' => ['backend.news.reverseHot']
			'roles' => [1,2]
			]);
		Route::post('product/reverseNew', [
			'as' => 'backend.product.reverseNew',
			'uses'  => 'ProductController@reverseNew',
			//'roles' => ['backend.news.reverseNew']
			'roles' => [1,2]
			]);
		Route::post('product/reverseStatus', [
			'as' => 'backend.product.reverseStatus',
			'uses'  => 'ProductController@reverseStatus',
			//'roles' => ['backend.news.reverseStatus']
			'roles' => [1,2]
			]);

		/*ReportController*/
		Route::get('report/indexGiahantem', [
			'as' => 'backend.report.indexGiahantem',
			'uses'  => 'ReportController@indexGiahantem',
			//'roles' => ['backend.report.indexGiahantem']
			'roles' => [1,2]
			]);
		Route::post('report/refreshTime', [
			'as' => 'backend.report.refreshTime',
			'uses'  => 'ReportController@refreshTime',
			//'roles' => ['backend.report.refreshTime']
			'roles' => [1,2]
			]);

		/*WinningController*/
		Route::get('winning/index', [
			'as' => 'backend.winning.index',
			'uses'  => 'WinningController@index',
			//'roles' => ['backend.winning.index']
			'roles' => [1,2]
			]);
		Route::get('winning/add', [
			'as' => 'backend.winning.vAdd',
			'uses'  => 'WinningController@add',
			//'roles' => ['backend.winning.add']
			'roles' => [1,2]
		]);
		Route::post('winning/add', [
			'as' => 'backend.winning.pAdd',
			'uses'  => 'WinningController@saveAdd',
			//'roles' => ['backend.winning.add']
			'roles' => [1,2]
		]);
		Route::get('winning/edit/{id}', [
			'as' => 'backend.winning.vEdit',
			'uses'  => 'WinningController@edit',
			//'roles' => ['backend.winning.add']
			'roles' => [1,2]
		]);
		Route::post('winning/edit/{id}', [
			'as' => 'backend.winning.pEdit',
			'uses'  => 'WinningController@edit',
			//'roles' => ['backend.winning.edit']
			'roles' => [1,2]
		]);
		Route::get('winning/delete/{id}', [
			'as' => 'backend.winning.delete',
			'uses'  => 'WinningController@delete',
			//'roles' => ['backend.winning.delete']
			'roles' => [1,2]
			]);

		/*QrcodeController*/
		Route::get('qrcode/index', [
			'as' => 'backend.qrcode.index',
			'uses'  => 'QrcodeController@index',
			//'roles' => ['backend.qrcode.index']
			'roles' => [1,2]
			]);
		Route::get('qrcode/add', [
			'as' => 'backend.qrcode.vAdd',
			'uses'  => 'QrcodeController@add',
			//'roles' => ['backend.qrcode.vAdd']
			'roles' => [1]
			]);
		Route::post('qrcode/add', [
			'as' => 'backend.qrcode.pAdd',
			'uses'  => 'QrcodeController@add',
			//'roles' => ['backend.qrcode.pAdd']
			'roles' => [1]
			]);
		Route::get('qrcode/edit/{id}', [
			'uses'  => 'QrcodeController@edit',
			//'roles' => ['backend.qrcode.vEdit']
			'roles' => [1]
			]);
		Route::post('qrcode/edit/{id}', [
			'as' => 'backend.qrcode.pEdit',
			'uses'  => 'QrcodeController@edit',
			//'roles' => ['backend.qrcode.pEdit']
			'roles' => [1]
			]);
		/*Route::get('qrcode/delete/{id}', [
			'as' => 'backend.qrcode.delete',
			'uses'  => 'QrcodeController@delete',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1]
			]);*/	
		Route::post('qrcode/checkStart', [
			'as' => 'backend.qrcode.checkStart',
			'uses'  => 'QrcodeController@checkStart',
			//'roles' => ['backend.qrcode.pImport']
			'roles' => [1]
			]);
		Route::get('qrcode/block/{company_id}/{guid}', [
			'as' => 'backend.qrcode.block',
			'uses'  => 'QrcodeController@block',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		
		Route::get('qrcode/block/delete', [
			'as' => 'backend.qrcode.deleteProductQrcode',
			'uses'  => 'QrcodeController@deleteProductQrcode',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1]
			]);
			
		Route::get('qrcode/block/checkResidual', [
			'as' => 'backend.qrcode.checkResidual',
			'uses'  => 'QrcodeController@checkResidual',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::post('qrcode/pBlock', [
			'as' => 'backend.qrcode.pBlock',
			'uses'  => 'QrcodeController@pBlock',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::get('qrcode/getForm/{type}/{company_id}/{guid}', [
			'as' => 'backend.qrcode.getForm',
			'uses'  => 'QrcodeController@getForm',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::post('qrcode/saveBlockPartner', [
			'as' => 'backend.qrcode.saveBlockPartner',
			'uses'  => 'QrcodeController@saveBlockPartner',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::post('qrcode/saveBlockProduct', [
			'as' => 'backend.qrcode.saveBlockProduct',
			'uses'  => 'QrcodeController@saveBlockProduct',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::get('qrcode/exportQrcode/{guid}/{type}', [
			'as' => 'backend.qrcode.exportQrcode',
			'uses'  => 'QrcodeController@exportQrcode',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1]
			]);
		Route::get('qrcode/active', [
			'as' => 'backend.qrcode.active',
			'uses'  => 'QrcodeController@active',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::get('qrcode/islock', [
			'as' => 'backend.qrcode.islock',
			'uses'  => 'QrcodeController@islock',
			//'roles' => ['backend.qrcode.lock']
			'roles' => [1,2]
			]);
		
		Route::get('qrcode/islock/edit/{id}', [
			'as' => 'backend.qrcode.islockedit',
			'uses'  => 'QrcodeController@islockedit',
			//'roles' => ['backend.qrcode.lock']
			'roles' => [1,2]
			]);	
	/*		
		Route::post('warranty/history/{id}', [
			'as' => 'backend.qrcode.islockpedit',
			'uses'  => 'QrcodeController@islockpedit',
			//'roles' => ['backend.user.pEdit']
			'roles' => [1]
			]);
   
	*/		
			
		Route::post('qrcode/renderQrcode', [
			'as' => 'backend.qrcode.renderQrcode',
			'uses'  => 'QrcodeController@renderQrcode',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::get('qrcode/previewQrcode', [
			'as' => 'backend.qrcode.previewQrcode',
			'uses'  => 'QrcodeController@previewQrcode',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::post('qrcode/destroyOrActiveQrcode', [
			'as' => 'backend.qrcode.destroyOrActiveQrcode',
			'uses'  => 'QrcodeController@destroyOrActiveQrcode',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::post('qrcode/destroyOrActiveMutipleQrcode', [
			'as' => 'backend.qrcode.destroyOrActiveMutipleQrcode',
			'uses'  => 'QrcodeController@destroyOrActiveMutipleQrcode',
			//'roles' => ['backend.qrcode.delete']
			'roles' => [1,2]
			]);
		Route::get('qrcode/deleteActiveQrcode/{id}', [
			'as' => 'backend.qrcode.deleteActiveQrcode',
			'uses'  => 'QrcodeController@deleteActiveQrcode',
			//'roles' => ['backend.qrcode.deleteActiveQrcode']
			'roles' => [1,2]
			]);
		Route::get('qrcode/getDropdownPartner/{company_id}', [
			'as' => 'backend.qrcode.getDropdownPartner',
			'uses'  => 'QrcodeController@getDropdownPartner',
			//'roles' => ['backend.qrcode.deleteActiveQrcode']
			'roles' => [1,2]
			]);
			
		Route::get('qrcode/configserial/{id}', [
			'as' => 'backend.qrcode.configserial',
			'uses'  => 'QrcodeController@configserial',
			//'roles' => ['backend.qrcode.deleteActiveQrcode']
			'roles' => [1,2]
			]);
		Route::post('qrcode/configserial/{id}', [
			'as' => 'backend.qrcode.vconfigserial',
			'uses'  => 'QrcodeController@editlot',
			//'roles' => ['backend.qrcode.deleteActiveQrcode']
			'roles' => [1,2]
			]);
			
			

		/*UserController*/
		Route::get('user/index', [
			'as' => 'backend.user.index',
			'uses'  => 'UserController@index',
			//'roles' => ['backend.user.index']
			'roles' => [1]
			]);
		Route::get('user/add', [
			'as' => 'backend.user.vAdd',
			'uses'  => 'UserController@add',
			//'roles' => ['backend.user.vAdd']
			'roles' => [1]
			]);
		Route::post('user/add', [
			'as' => 'backend.user.pAdd',
			'uses'  => 'UserController@add',
			//'roles' => ['backend.user.pAdd']
			'roles' => [1]
			]);
		Route::get('user/edit/{id}', [
			'as' => 'backend.user.vEdit',
			'uses'  => 'UserController@edit',
			//'roles' => ['backend.user.vEdit']
			'roles' => [1]
			]);
		Route::post('user/edit/{id}', [
			'as' => 'backend.user.pEdit',
			'uses'  => 'UserController@edit',
			//'roles' => ['backend.user.pEdit']
			'roles' => [1]
			]);
		Route::get('user/delete/{id}', [
			'as' => 'backend.user.delete',
			'uses'  => 'UserController@delete',
			//'roles' => ['backend.user.delete']
			'roles' => [1]
			]);
		Route::get('user/profile', [
			'as' => 'backend.user.profile',
			'uses'  => 'UserController@profile',
			//'roles' => ['backend.user.profile']
			'roles' => [1,2]
			]);
		Route::post('user/profile', [
			'as' => 'backend.user.pProfile',
			'uses'  => 'UserController@profile',
			//'roles' => ['backend.user.pProfile']
			'roles' => [1,2]
			]);
		Route::post('user/changePass', [
			'as' => 'backend.user.pChangePass',
			'uses'  => 'UserController@changePass',
			//'roles' => ['backend.user.pChangePass']
			'roles' => [1,2]
			]);
		Route::post('user/reverseStatus', [
			'as' => 'backend.user.reverseStatus',
			'uses'  => 'UserController@reverseStatus',
			//'roles' => ['backend.user.reverseStatus']
			'roles' => [1]
			]);

		/*RoleController*/
		Route::get('role/index', [
			'as' => 'backend.role.index',
			'uses'  => 'RoleController@index',
			'roles' => [1]
			]);
		Route::get('role/add', [
			'as' => 'backend.role.vAdd',
			'uses'  => 'RoleController@add',
			'roles' => [1]
			]);
		Route::post('role/add', [
			'as' => 'backend.role.pAdd',
			'uses'  => 'RoleController@add',
			'roles' => [1]
			]);
		Route::get('role/edit/{id}', [
			'as' => 'backend.role.vEdit',
			'uses'  => 'RoleController@edit',
			'roles' => [1]
			]);
		Route::post('role/edit/{id}', [
			'as' => 'backend.role.pEdit',
			'uses'  => 'RoleController@edit',
			'roles' => [1]
			]);
		Route::get('role/delete/{id}', [
			'as' => 'backend.role.delete',
			'uses'  => 'RoleController@delete',
			'roles' => [1]
			]);
	}
);

