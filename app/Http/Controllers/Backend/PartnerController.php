<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Company;
use App\Http\Models\Backend\Partner;
use App\Http\Models\Backend\ActiveQrcode;
use App\Http\Models\Backend\PartnerQrcode;


class PartnerController extends Controller
{
    public function index(Request $request) 
    {   
        $rs = Partner::with('company');

        $pageSize = Partner::PAGE_SIZE;
        $filter = [];
        if($request->has('pageSize') && $request->pageSize !== $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }

        if($request->has('name') == true && $request->name !== "") {
            $filter['name'] = $request->name;
            $rs = $rs->whereRaw("LOWER(name) LIKE CONCAT('%', CONVERT('".strtolower($filter['name'])."', BINARY),'%')");
        }
        if($request->has('company_id') && $request->company_id != '') {
            $filter['company_id'] = $request->company_id;
            $rs = $rs->where('company_id', $request->company_id);
        } elseif(!Auth::user()->hasAnyRole([1])) {
            $rs = $rs->whereIn('company_id', Company::getListIdsByAuth());
        }
        $data['listPartner'] = $rs->orderBy('id','DESC')->paginate($pageSize);
        $data['listCompany'] = Company::getListDropdown();
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
        return view('backend.partner.index', $data);
    }

    public function add(Request $request) 
    {
        if($request->isMethod('post')) {
            /*validate data request*/
            Validator::make($request->all(), [
                'company_id' => 'required',
                'name' => 'required|max:255',
                'email' => 'max:150',
                'tel' => 'max:50',
                'address' => 'max:255'
            ])->setAttributeNames([
                'company_id' => 'Tên doanh nghiệp',
                'name' => 'Tên nhà phân phối',
                'tel' => 'Số điện thoại',
                'address' => 'Địa chỉ'
            ])->validate();
            try {
                $partner = new Partner;
                $partner->company_id = $request->company_id;
                $partner->name = $request->name;
                $partner->email = $request->email;
                $partner->tel = $request->tel;
                $partner->address = $request->address;
                $partner->note = $request->note;
                $partner->created_by = Auth::user()->id;
                $partner->save();
                if($request->ajax()){
                    return response()->json(['data' => $partner]);
                }
                 \Session::flash('msg_partner', "Thêm mới thành công");
                return redirect()->route('backend.partner.index');
            } catch(Exception $e) {
                if($request->ajax()){
                    return response()->json(['msg'=>$e->getMessage()]);
                }
                return redirect()->route('backend.site.error', ['errorCode'=>404, 'msg'=>$e->getMessage()]);
            }
        }
        if(!Auth::user()->hasAnyRole([1])) {
            $data['company'] = Company::find(Auth::user()->company_id);
        }
        $data['listCompany'] = Company::getListDropdown();
        return view('backend.partner.add', $data);
    }

    public function edit(Request $request, $id) 
    {
        $partner = Partner::find($id);
        if($partner) {
            if($request->isMethod('post')) {
                /*validate data request*/
                Validator::make($request->all(), [
                    'company_id' => 'required',
                    'name' => 'required|max:255',
                    'email' => 'max:150',
                    'tel' => 'max:50',
                    'address' => 'max:255'
                ])->setAttributeNames([
                    'company_id' => 'Tên doanh nghiệp',
                    'name' => 'Tên nhà phân phối',
                    'tel' => 'Số điện thoại',
                    'address' => 'Địa chỉ'
                ])->validate();
                try {
                    $partner->company_id = $request->company_id;
                    $partner->name = $request->name;
                    $partner->email = $request->email;
                    $partner->tel = $request->tel;
                    $partner->address = $request->address;
                    $partner->note = $request->note;
                    $partner->active = $request->active;
                    $partner->created_by = Auth::user()->id;
                    $partner->save();
                    \Session::flash('msg_partner', "Cập nhật thành công");
                    return redirect()->route('backend.partner.index');
                } catch(Exception $e) {
                    return redirect()->route('backend.site.error', ['errorCode'=>404, 'msg'=>$e->getMessage()]);
                }
            } 
            $data['listCompany'] = Company::getListDropdown();
            $data['model'] = $partner;
            return view('backend.partner.edit', $data);
        } else {
            return redirect()->route('backend.site.error', ['errorCode'=>404, 'msg'=>"Not found request!"]);
        }
    }

    public function reverseStatus(Request $request) 
    {
        $response = [];
        $partner = Partner::find($request->id);
        if($partner) {
            if($partner->status == Partner::STATUS_ACTIVE) {
                $response['rm'] = 'fa-check-circle';
                $response['add'] = 'fa-question';
                $partner->status = Partner::STATUS_HIDE;
            } else {
                $response['add'] = 'fa-check-circle';
                $response['rm'] = 'fa-question';
                $partner->status = Partner::STATUS_ACTIVE;
            }
            $partner->save();
        } else {
            $response['error'] = true;
        }
        
        return response()->json($response);
    }

    public function delete($id) 
    {
        $ids = explode(",", $id);
        try {
            \DB::beginTransaction();
            Partner::destroy($ids);
            ActiveQrcode::whereIn('partner_id', $ids)->delete();
            PartnerQrcode::whereIn('partner_id', $ids)->delete();
            \DB::commit();
            \Session::flash('msg_partner', "Xóa thành công");
        } catch(Exception $e) {
            \DB::rollBack();
            \Session::flash('msg_partner', "Lỗi hệ thống. Vui lòng thử lại!");
        }
        return redirect()->route('backend.partner.index');
    }
}
