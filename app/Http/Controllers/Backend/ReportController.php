<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Backend\ProductQrcode;
use App\Http\Models\Backend\Company;

class ReportController extends Controller
{
    public function indexGiahantem(Request $request) 
    {
        $rs = ProductQrcode::with(['product', 'company']);
        $pageSize = ProductQrcode::PAGE_SIZE;
        $filter = [];
        if($request->has('pageSize') && $request->pageSize !== $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }
        if(Auth::user()->hasAnyRole([1]) && $request->has('company_id') && $request->company_id != 0) {
            $filter['company_id'] = $request->company_id;
            $rs = $rs->where('company_id', $filter['company_id']);
        }
        if(!Auth::user()->hasAnyRole([1])) {
            $rs = $rs->whereIn('company_id', Company::getListIdsByAuth());
        }

        if($request->has('guid') && $request->guid !== '') {
            $filter['guid'] = $request->guid;
            $rs = $rs->where('guid', $request->guid);
        }

        if($request->has('protected_time_of_tem') && $request->protected_time_of_tem != "") {
        	$filter['protected_time_of_tem'] = $request->protected_time_of_tem;
            $rs = $rs->where('protected_time_of_tem', '<=', $filter['protected_time_of_tem']);
        }
        $data['listProduct'] = $rs->orderBy('product_id')->paginate($pageSize);
        $data['listCompany'] = Company::getListDropdown();
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
    	return view('backend.report.indexGiahantem', $data);
    }

    public function refreshTime(Request $request) 
    {
        $response = [];
        $product = ProductQrcode::where('guid', $request->guid)
        						 ->where('product_id', $request->product_id)
        						 ->where('company_id', $request->company_id)
        						 ->first();
        if($product) {
            ProductQrcode::where('guid', $request->guid)
        						 ->where('product_id', $request->product_id)
        						 ->where('company_id', $request->company_id)
        						 ->update([
        						 	'protected_time_of_tem' => $request->protected_time_of_tem,
        						 	'created_at' => date('Y-m-d H:i:s', time())
        						 ]);
            $response['error'] = false;
        } else {
            $response['error'] = true;
        }
        
        return response()->json($response);
    }
}
