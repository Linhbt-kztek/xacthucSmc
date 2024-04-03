<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Product;
use App\Http\Models\Backend\ProductQrcode;
use App\Http\Models\Backend\Winning;
use App\Http\Models\Backend\Company;
use Excel;

class WinningController extends Controller
{
    public function index(Request $request) {
        $rs = Winning::with('product');
        $pageSize = Winning::PAGE_SIZE;
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

        if($request->has('product_id') && $request->product_id !== "") {
            $filter['product_id'] = $request->product_id;
            $rs = $rs->where('product_id', $product_id);
        }

        if($request->has('start_date') && $request->start_date !== '') {
            $filter['start_date'] = $request->start_date;
            $rs = $rs->where('start_date', '>=',$request->start_date);
        }
        if($request->has('end_date') && $request->end_date !== '') {
            $filter['end_date'] = $request->end_date;
            $rs = $rs->where('end_date', '<=',$request->end_date);
        }

        if($request->has('name') == true && $request->name !== "") {
            $filter['name'] = str_replace("'", "\\'", $request->name);
            $rs = $rs->whereRaw("LOWER(name) LIKE CONCAT('%', CONVERT('".strtolower($filter['name'])."', BINARY),'%')");
        }
        
        $data['listWinning'] = $rs->orderBy('id','DESC')->orderBy('name','ASC')->paginate($pageSize);
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
        $data['listProduct'] = Product::getListDropdown();
        $data['listCompany'] = Company::getListDropdown();
        return view('backend.winning.index', $data);
    }

    public function add(Request $request) {
        $company_id = $request->company_id;
        $guid = $request->guid;
        $products = ProductQrcode::where(['guid' => $guid, 'company_id' => $company_id])->get();
        $data = [
            'products' => $products,
            'company_id' => $company_id,
            'guid' => $guid
        ];
        return response()->json(['html' => view('backend.component.winning.add', $data)->render()]);        
    }

    public function saveAdd(Request $request) {
        //validate
        // todo
        
        $product = ProductQrcode::where('product_id', $request->product_id)
                                ->where('company_id', $request->company_id)
                                ->where('guid', $request->guid)
                                ->first();
        if(!$product) {
            return response()->json(['msg' => 'Sản phẩm chưa được chia khối.']);
        }

        $model = new Winning();
        $model->guid = $request->guid;
        $model->product_id = $request->product_id;
        $model->company_id = $request->company_id;
        $model->start_date = $request->start_date;
        $model->end_date = $request->end_date;
        $model->name = $request->name;
        $model->total_prize = $request->total_prize;
        $model->amount = $request->amount;
        $model->description = $request->description;
        $model->serial = implode(',', Winning::generateWinNumber(range($product->start, $product->end), $request->amount));
        if ($request->hasFile('introimage')) {
            $path = $request->file('introimage')->store(
                'winning/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time()), 'upload'
            );
            $model->introimage = 'upload/'.$path;
        }
        $model->save();
        return response()->json(['success' => 'Tạo giải thưởng thành công!']);
    }

    public function delete($id) 
    {
        $ids = explode(",", $id);
        try {
            \DB::beginTransaction();
            $winnings = Winning::whereIn('id', $ids);
            foreach ($winnings as $winning) {
                if(file_exists($winning->introimage)) {
                    unlink($winning->introimage);
                }
            }
            $winnings->delete();
            \DB::commit();  
            \Session::flash('msg_winning', "Xóa thành công");
        } catch(Exception $e) {
            \DB::rollBack();
            \Session::flash('msg_winning', "Lỗi hệ thống. Vui lòng thử lại!");
        }
        return redirect()->route('backend.winning.index');
    }
    
    // - check xóa sản phẩm khỏi khối: check trong bảng winning xem có ton tai sản pham đó k.
    // - update winning
    // + check sp có tồn tại trong winning k,
    // + còn thòi gian trao thưởng k
    // + đúng serial k (hoặc còn sp để trao giải k (pay_winning < amount))
    // + 

}
