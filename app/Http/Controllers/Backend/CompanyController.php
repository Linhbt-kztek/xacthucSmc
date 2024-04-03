<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Company;
use App\Http\Models\Backend\Partner;
use App\Http\Models\Backend\Product;
use App\Http\Models\Backend\ActiveQrcode;
use App\Http\Models\Backend\PartnerQrcode;
use App\Http\Models\Backend\ProductQrcode;
use App\Http\Models\Backend\Qrcode;
use App\Http\Models\Backend\User;

class CompanyController extends Controller
{
    public function index(Request $request) 
    {   
        $rs = Company::select('*');
        $pageSize = Company::PAGE_SIZE;
        $filter = [];
        if($request->has('pageSize') && $request->pageSize !== $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }

        if($request->has('name') == true && $request->name !== "") {
            $filter['name'] = $request->name;
            $rs = $rs->whereRaw("LOWER(name) LIKE CONCAT('%', CONVERT('".strtolower($filter['name'])."', BINARY),'%')");
        }
        if(!Auth::user()->hasAnyRole([1])) {
            $rs = $rs->where('asign_to', Auth::user()->id);
        }
        $data['listCompany'] = $rs->orderBy('id','DESC')->paginate($pageSize);
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
    	return view('backend.company.index', $data);
    }

    public function add(Request $request) 
    {
        if($request->isMethod('post')) {
        	/*validate data request*/
            Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|max:150',
                'tel' => 'required|max:50',
                'address' => 'required|max:555',
                'code_tax' => 'max:50',
                'website' => 'max:255',
                'warranty' => 'max:255',
                'asign_to' => 'required'
            ])->setAttributeNames([
                'name' => 'Tên doanh nghiệp',
                'email' => 'Email',
                'tel' => 'Số điện thoại',
                'address' => 'Địa chỉ',
                'code_tax' => 'Mã số thuế',
                'website' => 'Website',
                'asign_to' => 'User quản lý'
            ])->validate();
            $company = new Company;
            $company->name = $request->name;
            $company->email = $request->email;
            $company->tel = $request->tel;
            $company->facebooklink = $request->facebooklink;
            $company->address = $request->address;
            $company->code_tax = $request->code_tax;
            $company->website = $request->website;
            $company->warranty = $request->warranty;
            $company->intro = $request->intro;
            if ($request->hasFile('introimage')) {
                $path = $request->file('introimage')->store(
                    'company/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time()), 'upload'
                );
                $company->introimage = 'upload/'.$path;
            }
            $company->asign_to = $request->asign_to;
            $company->created_by = Auth::user()->id;
            $company->save();
            \Session::flash('msg_company', "Thêm mới thành công");
            return redirect()->route('backend.company.index');
        }
        $data['listUser'] = User::getListDropdownCompany();
    	return view('backend.company.add', $data);
    }

    public function edit(Request $request, $id) 
    {
        $company = Company::find($id);
        if($company) {
	        if($request->isMethod('post')) {
	        	/*validate data request*/
                Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:150',
                    'tel' => 'required|max:50',
                    'address' => 'required|max:555',
                    'code_tax' => 'max:50',
                    'website' => 'max:255',
                    'warranty' => 'max:255',
                    'asign_to' => 'required'
                ])->setAttributeNames([
                    'name' => 'Tên doanh nghiệp',
                    'email' => 'Email',
                    'tel' => 'Số điện thoại',
                    'address' => 'Địa chỉ',
                    'code_tax' => 'Mã số thuế',
                    'website' => 'Website',
                    'warranty' => 'warranty',
                    'asign_to' => 'User quản lý'
                ])->validate();
                $company->name = $request->name;
                $company->email = $request->email;
                $company->tel = $request->tel;
                $company->facebooklink = $request->facebooklink;
                $company->address = $request->address;
                $company->code_tax = $request->code_tax;
                $company->website = $request->website;
                $company->warranty = $request->warranty;
                $company->intro = $request->intro;
                if ($request->hasFile('introimage')) {
                    $path = $request->file('introimage')->store(
                        'company/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time()), 'upload'
                    );
                    $company->introimage = 'upload/'.$path;
                }
                $company->asign_to = $request->asign_to;
                $company->created_by = Auth::user()->id;
                $company->save();
                \Session::flash('msg_company', "Cập nhật thành công");
                return redirect()->route('backend.company.index');
	        } 
            $data['model'] = $company;
            $data['listUser'] = User::getListDropdownCompany();
	    	return view('backend.company.edit', $data);
	    } else {
	    	return redirect()->route('backend.site.error', ['errorCode'=>404, 'msg'=>"Not found request!"]);
	    }
    }

    public function delete($id) 
    {
        $ids = explode(",", $id);return;
        try {
            \DB::beginTransaction();
            $companys = Company::whereIn('id', $ids);
            foreach ($companys as $company) {
                if(file_exists($company->introimage)) {
                    unlink($company->introimage);
                }
            }
            $companys->delete();
            Partner::whereIn('company_id', $ids)->delete();
            Product::whereIn('company_id', $ids)->delete();
            ActiveQrcode::whereIn('company_id', $ids)->delete();
            PartnerQrcode::whereIn('company_id', $ids)->delete();
            ProductQrcode::whereIn('company_id', $ids)->delete();
            Qrcode::whereIn('company_id', $ids)->delete();
            \DB::commit();
            \Session::flash('msg_company', "Xóa thành công");
        } catch(Exception $e) {
            \DB::rollBack();
            \Session::flash('msg_company', "Lỗi hệ thống. Vui lòng thử lại!");
        }

        return redirect()->route('backend.company.index');
    }
}