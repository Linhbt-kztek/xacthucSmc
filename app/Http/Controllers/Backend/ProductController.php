<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Product;
use App\Http\Models\Backend\Company;
use App\Http\Models\Backend\ActiveQrcode;
use App\Http\Models\Backend\ProductQrcode;
use App\Http\Models\Backend\ProductImage;
use App\Http\Models\Backend\Qrcode;

class ProductController extends Controller
{
    public function index(Request $request) 
    {
        $rs = Product::with('company');
        $pageSize = Product::PAGE_SIZE;
        $filter = [];
        if($request->has('pageSize') && $request->pageSize !== $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }

        if($request->has('company_id') && $request->company_id !== "") {
            $filter['company_id'] = $request->company_id;
            $rs = $rs->where('company_id', $filter['company_id']);
        } elseif(!Auth::user()->hasAnyRole([1])) {
            $rs = $rs->whereIn('company_id', Company::getListIdsByAuth());
        }

        if($request->has('code') && $request->code !== "") {
            $filter['code'] = $request->code;
            $rs = $rs->where('code', 'like', '%'.$filter['code'].'%');
        }
         
         if($request->has('bathcode') && $request->bathcode !== "") {
            $filter['batchcode'] = $request->batchcode;
            $rs = $rs->where('bathcode', 'like', '%'.$filter['bathcode'].'%');
        }
        if($request->has('reward') && $request->reward !== "") {
            $filter['reward'] = $request->reward;
            $rs = $rs->where('reward', 'like', '%'.$filter['reward'].'%');
        }
        

        if($request->has('protected_time') && $request->protected_time !== "") {
            $filter['protected_time'] = $request->protected_time;
            $rs = $rs->where('protected_time', $filter['protected_time']);
        }

        if($request->has('name') == true && $request->name !== "") {
            $filter['name'] = str_replace("'", "\\'", $request->name);
            $rs = $rs->whereRaw("LOWER(name) LIKE CONCAT('%', CONVERT('".strtolower($filter['name'])."', BINARY),'%')");
        }
        
        $data['listProduct'] = $rs->orderBy('id','DESC')->orderBy('name','ASC')->paginate($pageSize);
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
        $data['listCompany'] = Company::getListDropdown();
    	return view('backend.product.index', $data);
    }

    public function add(Request $request) 
    {
        if($request->isMethod('post')) {
            /*validate data request*/
            Validator::make($request->all(), [
                'company_id' => 'required',
                'name' => 'required|max:255',
                'code' => 'max:50',
                
                /*'introimage' => 'required',
                'date_output' => 'required',
                'protected_time' => 'required',
                'description' => 'required'*/
            ])->setAttributeNames([
                'company_id' => 'Thuộc doanh nghiệp',
                'name' => 'Tên sản phẩm',
                'code' => 'Mã sản phẩm',
                /*'introimage' => 'Ảnh đại diện',
                'date_output' => 'Ngày sản xuất',
                'protected_time' => 'Thời gian bảo hành',
                'description' => 'Chi tiết sản phẩm'*/
            ])->validate();
            try {
                $product = new Product;
                $product->company_id = $request->company_id;
                $product->code = $request->code;
                $product->batchcode = $request->batchcode;
                $product->name = $request->name;
                $product->reward = $request->reward;
                 $product->price = $request->price;
                $product->date_output = $request->date_output;
                $product->date_off = $request->date_off;
                $product->protected_time = $request->protected_time;
                $product->description = $request->description;
                $product->formactive = $request->formactive;
                $product->formlabel = $request->formlabel;
                $product->formnote = $request->formnote;
                
                if ($request->hasFile('introimage')) {
                    
                  
                    
                    $path = $request->file('introimage')[0]->store(
                        'product/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time()), 'upload'
                    );
                    $product->introimage = 'upload/'.$path;
                } elseif ($request->has('introimage_copy') && $request->introimage_copy != '') {
                    $product->introimage = $request->introimage_copy;
                }
                $product->created_by = Auth::user()->id;
                $product->save();
                /* save product image*/
                if ($request->hasFile('introimage')) {
                    $dataImage = [];
                    foreach ($request->file('introimage') as $key => $img) {
                        if($key == 0) {
                            array_push($dataImage, [
                                'id' => Qrcode::getGUID(),
                                'product_id' =>$product->id,
                                'path' => $product->introimage
                            ]);
                        } else {
                            $path = $img->store('product/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time()), 'upload');
                            array_push($dataImage, [
                                'id' => Qrcode::getGUID(),
                                'product_id' =>$product->id,
                                'path' => 'upload/'.$path
                            ]);
                        }
                    }
                    if(count($dataImage) > 0) {
                        ProductImage::insert($dataImage);
                    }
                }

                if($request->ajax()){
                    $product->introimage = asset($product->introimage);
                    return response()->json(['data' => $product]);
                }
                \Session::flash('msg_product', "Thêm mới thành công");
                return redirect()->route('backend.product.index');
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
    	return view('backend.product.add', $data);
    }

    public function edit(Request $request, $id) 
    {
        $product = Product::find($id);
        if($product) {
            if($request->isMethod('post')) {
                /*validate data request*/
                Validator::make($request->all(), [
                    'company_id' => 'required',
                    'name' => 'required|max:255',
                    'code' => 'max:50',
                    /*'introimage' => 'required',
                    'date_output' => 'required',
                    'protected_time' => 'required',
                    'description' => 'required'*/
                ])->setAttributeNames([
                    'company_id' => 'Thuộc doanh nghiệp',
                    'name' => 'Tên sản phẩm',
                    'code' => 'Mã sản phẩm',
                    /*'introimage' => 'Ảnh đại diện',
                    'date_output' => 'Ngày sản xuất',
                    'protected_time' => 'Thời gian bảo hành',
                    'description' => 'Chi tiết sản phẩm'*/
                ])->validate();
                try {
                    $product->company_id = $request->company_id;
                    $product->code = $request->code;
                    $product->batchcode = $request->batchcode;
                    $product->name = $request->name;
                     $product->price = $request->price;
                    $product->date_output = $request->date_output;
                    $product->date_off = $request->date_off;
                    $product->protected_time = $request->protected_time;
                    $product->description = $request->description;
                    $product->time_out = $request->time_out;
                    $product->reward = $request->reward;
                    $product->formactive = $request->formactive;
                    $product->serialshow = $request->serialshow;
                    $product->formlabel = $request->formlabel;
                    $product->formnote = $request->formnote;
                    
                    $product->alertmessage = $request->alertmessage;
                    $product->productinfo = $request->productinfo;
                    $product->companyinfo = $request->companyinfo;
                    $product->parnerinfo = $request->parnerinfo;
                    
                    if ($request->hasFile('introimage')) {
                        $path = $request->file('introimage')[0]->store(
                            'product/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time()), 'upload'
                        );
                        foreach ($product->product_image as $key => $img) {
                            if(file_exists($img->path)) {
                                unlink($img->path);
                            }
                            $img->delete();
                        }
                        
                        $product->introimage = 'upload/'.$path;
                    }
                    $product->created_by = Auth::user()->id;
                    $product->save();

                    /* save product image*/
                    if ($request->hasFile('introimage')) {
                        $dataImage = [];
                        foreach ($request->file('introimage') as $key => $img) {
                            if($key == 0) {
                                array_push($dataImage, [
                                    'id' => Qrcode::getGUID(),
                                    'product_id' =>$product->id,
                                    'path' => $product->introimage
                                ]);
                            } else {
                                $path = $img->store('product/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time()), 'upload');
                                array_push($dataImage, [
                                    'id' => Qrcode::getGUID(),
                                    'product_id' =>$product->id,
                                    'path' => 'upload/'.$path
                                ]);
                            }
                        }
                        if(count($dataImage) > 0) {
                            ProductImage::insert($dataImage);
                        }
                    }

                    \Session::flash('msg_product', "Cập nhật thành công");
                    return redirect()->route('backend.product.index');
                } catch(Exception $e) {
                    return redirect()->route('backend.site.error', ['errorCode'=>404, 'msg'=>$e->getMessage()]);
                }
            } 
            $data['listCompany'] = Company::getListDropdown();
            $data['model'] = $product;
            
        	return view('backend.product.edit', $data);
        } else {
            return redirect()->route('backend.site.error', ['errorCode'=>404, 'msg'=>"Not found request!"]);
        }
    }

    public function copy($id) {
        $product = Product::find($id);
        if($product) {
            $data['company'] = Company::find($product->company_id);
            $data['listCompany'] = Company::getListDropdown();
            $introimage = $product->introimage != '' ? asset($product->introimage): '';
            $view = view('backend.component.product.add', $data)->render();
            return response()->json(['html' => $view, 'product' => $product, 'introimage' => $introimage]);
        } else {
            return response()->json(['errorCode'=>404, 'msg'=>"Not found request!"]);
        }
    }

    public function delete($id) 
    {
        $ids = explode(",", $id);
        try {
            \DB::beginTransaction();
            $products = Product::whereIn('id', $ids);
            foreach ($products as $product) {
                if(file_exists($product->introimage)) {
                    unlink($product->introimage);
                }
            }
            $products->delete();
            ActiveQrcode::whereIn('product_id', $ids)->delete();
            ProductQrcode::whereIn('product_id', $ids)->delete();
            \DB::commit();  
            \Session::flash('msg_product', "Xóa thành công");
        } catch(Exception $e) {
            \DB::rollBack();
            \Session::flash('msg_product', "Lỗi hệ thống. Vui lòng thử lại!");
        }
        return redirect()->route('backend.product.index');
    }
}
