<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Company;
use App\Http\Models\Backend\Qrcode;
use App\Http\Models\Backend\Partner;
use App\Http\Models\Backend\Product;
use App\Http\Models\Backend\ActiveQrcode;
use App\Http\Models\Backend\ProductQrcode;
use App\Http\Models\Backend\PartnerQrcode;
use App\Http\Models\Backend\Warranty;
use App\Http\Models\Backend\Warrantyhistory;

use Excel;

class QrcodeController extends Controller
{
    public function index(Request $request)
    {
        $rs = Qrcode::with('company');
        $pageSize = Qrcode::PAGE_SIZE;
        $filter = [];
        if ($request->has('pageSize') && $request->pageSize !== $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }
        if ($request->has('company_id') && $request->company_id != 0) {
            $filter['company_id'] = $request->company_id;
            $rs = $rs->where('company_id', $filter['company_id']);
        } elseif (!Auth::user()->hasAnyRole([1])) {
            $rs = $rs->whereIn('company_id', Company::getListIdsByAuth());
        }

        ////////// Em Công mới thêm vào để lọc theo ngày tháng //////////
        if ($request->has('start_date') && $request->start_date !== '') {
            $filter['created_at'] = $request->start_date;
            $rs = $rs->where('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date !== '') {
            $filter['created_at'] = $request->end_date;
            $rs = $rs->where('created_at', '<=', $request->end_date);
        }
        //$rs=$rs->orderBy('created_at', 'DESC');
        ////////// End of Em Công mới thêm vào để lọc theo ngày tháng /




        $data['listQrcode'] = $rs->orderBy('created_at', 'DESC')->paginate($pageSize);
        $data['listCompany'] = Company::getListDropdown();
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;

        return view('backend.qrcode.index', $data);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            /*validate data request*/
            Validator::make($request->all(), [
                'company_id' => 'required | integer',
                'start' => 'required | integer',
                'end' => 'required|integer'
            ])->setAttributeNames([
                'company_id' => 'Chọn doanh nghiệp',
                'start' => 'Serial đầu',
                'end' => 'Serial cuối'
            ])->validate();
            $check_start = Qrcode::checkStart($request->company_id, $request->start);
            if ($check_start != '') {
                return redirect()->route('backend.qrcode.vAdd')->withErrors($check_start);
            }
            $qrcode = new Qrcode;
            $qrcode->guid = Qrcode::getGUID();
            $qrcode->company_id = $request->company_id;
            $qrcode->start = $request->start;
            $qrcode->end = $request->end;
            $qrcode->note = $request->note;
            $qrcode->prefix = $request->prefix;
            $qrcode->seriallength = $request->seriallength;
            $qrcode->type = Qrcode::TYPE_NEW;
            $qrcode->created_by = Auth::user()->id;
            $qrcode->save();
            \Session::flash('msg_qrcode', "Thêm mới thành công");
            return redirect()->route('backend.qrcode.index');
        }
        /*get all company*/
        $data['listCompany'] = Company::getListDropdown();
        return view('backend.qrcode.add', $data);
    }

    /*public function edit(Request $request, $id) 
    {
        $qrcode = Qrcode::find($id);
        if($qrcode) {
            if($request->isMethod('post')) {
                Validator::make($request->all(), [
                    'company_id' => 'required | integer',
                    'start' => 'required | integer',
                    'end' => 'required|integer'             
                ])->setAttributeNames([
                    'company_id' => 'Chọn doanh nghiệp',
                    'start' => 'Serial đầu',
                    'end' => 'Serial cuối'
                ])->validate();
                $check_start = Qrcode::checkStart($request->company_id, $request->start);
                if($check_start != '') {
                    return redirect()->route('backend.qrcode.vEdit',['id'=>$qrcode->guid])->withErrors($check_start);
                }
                $qrcode->company_id = $request->company_id;
                $qrcode->start = $request->start;
                $qrcode->end = $request->end;
                $qrcode->created_by = Auth::user()->id;
                $qrcode->save();
                \Session::flash('msg_qrcode', "Cập nhật thành công");
                return redirect()->route('backend.qrcode.index');
            } 
            $data['listCompany'] = Company::select('id', 'name')->orderBy('id','ASC')->get(); 
            $data['model'] = $qrcode;
            return view('backend.qrcode.edit', $data);
        } else {
            return redirect()->route('backend.site.error', ['errorCode'=>404, 'msg'=>"Not found request!"]);
        }
    }*/


 public function configserial(Request $request, $id) 
    {


        $rs =  ProductQrcode::find($id);
        $pageSize = ProductQrcode::PAGE_SIZE;
        $filter = [];
        $data['listProductQrcode'] = $rs;
        return view('backend.qrcode.configserial', $data);
    }
    
    
   public function editlot(Request $request, $id) 
    {
        $rs = ProductQrcode::find($id);
        if($rs) {
            if($request->isMethod('post')) {
                /*validate data request*/
                Validator::make($request->all(), [
                    'product_sku' => 'max:255',
                    
                ])->setAttributeNames([
                    
                    
                ])->validate();
               
                try {
                    \DB::beginTransaction();
                    $rs->product_sku = $request->product_sku;
                    $rs->product_batchcode = $request->product_batchcode;
                    $rs->product_price = $request->product_price;
                    $rs->date_output = $request->date_output;
                    $rs->date_off = $request->date_off;
                    $rs->protected_time = $request->protected_time;
                    $rs->serialshow = $request->serialshow;
                    $rs->activeform = $request->activeform;
                    $rs->Reward_activecode = $request->Reward_activecode;
                    $rs->form_label = $request->form_label;
                    $rs->form_mesage = $request->form_mesage;
                    
                    
                    
                  
                    $rs->save();
                    \DB::commit();
                    \Session::flash('msg_warranty', "Cập nhật thành công");
                    return redirect()->route('backend.qrcode.configserial',[$id]);
                } catch (Exception $e) {
                    \DB::rollBack();
                    return redirect()->route('backend.site.error');
                }
            }
          
          
          
        } else {
            return redirect()->route('backend.site.error');
        }
    }
    
    
    
    public function checkStart(Request $request)
    {
        if ($request->has('type')) {
            return response()->json([
                '_start' => Qrcode::checkStart($request->company_id, 0, 'get')
            ]);
        } else {
            return response()->json([
                'msg' => Qrcode::checkStart($request->company_id, $request->start)
            ]);
        }
    }

    /*public function delete($id) 
    {
        $ids = explode(",", $id);
        Qrcode::destroy($ids);
        \Session::flash('msg_qrcode', "Xóa thành công");
        return redirect()->route('backend.qrcode.index');
    }*/


    public function block(Request $request)
    {
        $check = [
            'checkPartner' => true,
            'checkProduct' => true
        ];
        $list_partner = Partner::select('partner.id', 'partner.name', 'partner.active', 'partner_qrcode.start', 'partner_qrcode.end', 'partner_qrcode.amount')
            ->join('partner_qrcode', function ($join) use ($request) {
                $join->on('partner.id', '=', 'partner_qrcode.partner_id');
                $join->where('partner_qrcode.guid', $request->guid);
            })
            ->where('partner.company_id', $request->company_id)
            ->orderBy('partner_qrcode.start', 'ASC')
            ->get();
        if (count($list_partner) == 0) {
            $list_partner = Partner::select('partner.id', 'partner.name', 'partner.active', \DB::raw('\'\' as start, \'\' as end, \'\' as amount'))
                ->where('partner.company_id', $request->company_id)
                ->orderBy('partner.id', 'ASC')
                ->get();
            $check['checkPartner'] = false;
        }
        $data_product = Product::select('product.id', 'product.code', 'product.name', 'product.introimage', 'product_qrcode.start', 'product_qrcode.end', 'product_qrcode.amount', 'protected_time_of_tem', 'product_qrcode.id as product_qrcode_id')
            ->join('product_qrcode', function ($join) use ($request) {
                $join->on('product.id', '=', 'product_qrcode.product_id');
                $join->where('product_qrcode.guid', $request->guid);
            })
            ->where('product.company_id', $request->company_id)
            ->orderBy('product_qrcode.id', 'desc')
            ->orderBy('product_qrcode.start', 'ASC');
        // ->get();


        $all_list_product = $data_product->get();

        if (count($all_list_product) == 0) {
            $data_product = Product::select('product.id', 'product.code', 'product.name', 'product.introimage', \DB::raw('\'\' as start, \'\' as end, \'\' as amount'))
                ->where('product.company_id', $request->company_id)
                ->orderBy('product.id', 'ASC');
            // ->get();
            $check['checkProduct'] = false;
        }

        $list_product = $data_product->paginate(5);

        $data['block'] = Qrcode::select('guid', 'start', 'end', 'company_id')
            ->where('guid', $request->guid)
            ->where('company_id', $request->company_id)
            ->first();

        $data['listPartner'] = $list_partner;
        $data['listProduct'] = $list_product;
        $data['all_list_product'] = $all_list_product;


        $data['check'] = $check;
        return view('backend.qrcode.block', $data);
    }

    public function checkResidual(Request $request)
    {
        $block = Qrcode::select('guid', 'start', 'end', 'company_id')
            ->where('guid', $request->guid)
            ->where('company_id', $request->company_id)
            ->first();

        $data_product = Product::select('product.id', 'product.code', 'product.name', 'product.introimage', 'product_qrcode.start', 'product_qrcode.end', 'product_qrcode.amount', 'protected_time_of_tem', 'product_qrcode.id as product_qrcode_id')
            ->join('product_qrcode', function ($join) use ($request) {
                $join->on('product.id', '=', 'product_qrcode.product_id');
                $join->where('product_qrcode.guid', $request->guid);
            })
            ->where('product.company_id', $request->company_id)
            ->whereNotIn('product_qrcode.id', $request->product_qrcode_id)
            ->orderBy('product_qrcode.start', 'ASC');
        $list_product = $data_product->get();

        $new_data = [];

        foreach ($request->used_arr as $number => $value) {
            if ($number % 2 === 0) {
                $new_data[$value] = [
                    'start' => (int)$value,
                    'end' => (int)$request->used_arr[$number + 1],
                ];
            }
        }

        foreach ($list_product as $value) {
            $new_data[$value->start] = [
                'start' => $value->start,
                'end' => $value->end,
            ];
        }
        ksort($new_data);

        // dd($request->all(),$list_product);

        $data_for_check = [];
        foreach ($new_data as $value) {
            $data_for_check[] = [
                'start' => $value['start'],
                'end' => $value['end'],
            ];
        }

        $residual_product = [];
        $total = 0;

        foreach ($data_for_check as $key => $value) {
            $start = $value['start'];
            $end = $value['end'];
            if ($key == 0 && $start > $block->start) {
                $residual_product[] = [$block->start, ($start - 1)];
            }
            if ($key > 0 && ($start - 1) > $data_for_check[$key - 1]['end']) {
                $residual_product[] = [($data_for_check[$key - 1]['end'] + 1), ($start - 1)];
            }
            if ($key == (count($data_for_check) - 1) && $end < $block->end) {
                $residual_product[] = [($end + 1), $block->end];
            }
            $total += $end - $start + 1;
        }

        if (count($residual_product) > 0) {
            foreach ($residual_product as $key => $item) {
                $residual_product[$key] = '[' . implode('-', $item) . ']';
            }
        }

        $data_return = [
            'status' => 200,
            'message' => '',
            'result' => implode(',', $residual_product),
            'total' => $total
        ];
        return response()->json($data_return);
    }

    public function getForm($type, $company_id, $guid)
    {
        if ($type == 1) {
            $data['guid'] = $guid;
            $data['listCompany'] = Company::getListDropdown();
            $view = view('backend.component.partner.add', $data)->render();
        } else if ($type == 2) {
            $data['guid'] = $guid;
            $data['company_id'] = $company_id;
            $data['listCompany'] = Company::getListDropdown();
            $view = view('backend.component.product.add', $data)->render();
        } else if ($type == 3) {
            $data['listPartner'] = Partner::select('id', 'name')
                ->where('company_id', $company_id)
                ->orderBy('name', 'ASC')->get();
            $view = view('backend.component.partner.list_partner_ajax', $data)->render();
            //} else if($type == 4) {
        } else {
            $data['listProduct'] = Product::select('id', 'name', 'introimage', 'code')
                ->where('company_id', $company_id)
                ->orderBy('id', 'DESC')->get();
            $view = view('backend.component.product.list_product_ajax', $data)->render();
        }
        return response()->json(['html' => $view]);
    }

    public function deleteProductQrcode(Request $request)
    {
        // dd($request->all());
        $product_qrcode = \DB::table('product_qrcode')
            ->where('id', $request->product_qrcode_id)->get();
        if (!empty($product_qrcode)) {
            \DB::table('product_qrcode')
                ->where('id', $request->product_qrcode_id)
                ->delete();
            $data_return = [
                'status' => 200,
                'message' => 'Xóa thành công!',
                'result' => '',
            ];
        } else {
            $data_return = [
                'status' => 90,
                'message' => 'Xảy ra lỗi trong quá trình xóa dữ liệu!',
                'result' => '',
            ];
        }
        return response()->json($data_return);
    }

    public function saveBlockProduct(Request $request)
    {
        // dd($request->all());
        $data_insert = [];
        $list_old_id = [];
        try {
            if ($request->has('product')) {
                foreach ($request->product as $key => $product) {
                    $id = $product['id'];
                    if ($product['start'] != '' && $product['end'] != '' && $product['amount'] != '') {
                        $insert_item = [];
                        $insert_item['guid'] = $request->guid;
                        $insert_item['company_id'] = $request->company_id;
                        $insert_item['product_id'] = $id;
                        $insert_item['start'] = $product['start'];
                        $insert_item['amount'] = $product['amount'];
                        $insert_item['end'] = $product['end'];
                        $insert_item['protected_time_of_tem'] = $product['protected_time_of_tem'];
                        $insert_item['created_by'] = Auth::user()->id;
                        $insert_item['created_at'] = date('Y-m-d H:i:s');
                        $insert_item['updated_at'] = date('Y-m-d H:i:s');
                        $data_insert[] = $insert_item;
                        if (!empty($product['product_qrcode_id'])) {
                            $list_old_id[] =  $product['product_qrcode_id'];
                        }
                    }
                }
            }
            \DB::table('product_qrcode')
                ->where('company_id', $request->company_id)
                ->where('guid', $request->guid)
                ->whereIn('id', $list_old_id)
                ->delete();
            if (count($data_insert) > 0) {
                \DB::table('product_qrcode')->insert($data_insert);
            }
            return response()->json(['msg' => 'Lưu thành công!']);
        } catch (Exception $e) {
            return response()->json(['msg' => 'Có lỗi xảy ra!']);
        }
    }

    public function saveBlockPartner(Request $request)
    {
        $data_insert = [];
        try {
            if ($request->has('partner')) {
                foreach ($request->partner as $key => $partner) {
                    $id = $partner['id'];
                    if ($partner['start'] != '' && $partner['end'] != '' && $partner['amount'] != '') {
                        $insert_item = [];
                        $insert_item['guid'] = $request->guid;
                        $insert_item['company_id'] = $request->company_id;
                        $insert_item['partner_id'] = $id;
                        $insert_item['start'] = $partner['start'];
                        $insert_item['amount'] = $partner['amount'];
                        $insert_item['end'] = $partner['end'];
                        $insert_item['created_by'] = Auth::user()->id;
                        $insert_item['created_at'] = date('Y-m-d H:i:s');
                        $insert_item['updated_at'] = date('Y-m-d H:i:s');
                        $data_insert[] = $insert_item;
                    }
                }
            }
            \DB::table('partner_qrcode')
                ->where('company_id', $request->company_id)
                ->where('guid', $request->guid)
                ->delete();
            if (count($data_insert) > 0) {
                \DB::table('partner_qrcode')->insert($data_insert);
            }
            return response()->json(['msg' => 'Lưu thành công!']);
        } catch (Exception $e) {
            return response()->json(['msg' => 'Có lỗi xảy ra!']);
        }
    }

    public function exportQrcode($guid, $type)
    {
        set_time_limit(3600);
        ob_end_clean();
        ob_start();
        $qrcode = Qrcode::find($guid);
        if ($qrcode) {
            /*$data[] = [
                'STT',
                'Serial',
                'Value QR Code'
            ];*/
            $data = [];
            $stt = 1;
            /* type = 1: xacthuc.smartcheck, type = 2: open*/
            if ($type == 1) {
                for ($i = $qrcode->start; $i <= $qrcode->end; $i++) {
                    $data[] = [
                        $stt,
                        str_pad($i, 10, '0', STR_PAD_LEFT),
                        Qrcode::PRE_TEXT . $guid . '-' . Qrcode::encodeSerial($i)
                    ];
                    $stt++;
                }
            } else {
                for ($i = $qrcode->start; $i <= $qrcode->end; $i++) {
                    $data[] = [
                        $stt,
                        $qrcode->prefix . str_pad($i, $qrcode->seriallength, '0', STR_PAD_LEFT),
                        config('app.url_qrcode') . Qrcode::PRE_TEXT . $guid . '-' . Qrcode::encodeSerial($i)
                    ];
                    $stt++;
                }
            }

            /*Excel::create('QR_Code_'.$guid, function($excel) use ($data) {
                $excel->sheet('Sheet 1', function ($sheet) use ($data) {
                    $sheet->setOrientation('portrait');
                    // Font family
                    $sheet->setFontFamily('Times New Roman');
                    // Font size
                    $sheet->setFontSize(13);
                    // Font bold
                    $sheet->setFontBold(false);
                    // set border
                    $sheet->setBorder('A4:C'.(count($data) + 3), 'thin');
                    // set title
                    $sheet->mergeCells('A1:C2');
                    $sheet->cell('A1', function($cell) {
                        $cell->setValue('Danh sách QRCode');
                        // Set horizontal alignment 
                        $cell->setAlignment('center');
                        // Set font 
                        $cell->setFont(array(
                            'size'       => '20',
                            'bold'       =>  true
                        ));
                    });
                    // set header column 
                    $sheet->cells('A4:C4', function($cells) {
                        $cells->setAlignment('center');
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setBackground("#C1F9F9");
                    });
                    // Set vertical alignment for all 
                    $sheet->cells('A1:C'.(count($data) + 3), function($cells) {
                        // Set vertical alignment 
                        $cells->setValignment('center');                    
                    });
                    // Set horizontal alignment for all 
                    $sheet->cells('B5:C'.(count($data) + 3), function($cells) {
                        // Set vertical alignment 
                        $cells->setAlignment('left');                   
                    });

                    $sheet->cells('A5:A'.(count($data) + 3), function($cells) {
                        // Set vertical alignment 
                        $cells->setAlignment('center');                   
                    });
                    $sheet->fromArray($data, NULL, 'A4', false, false);
                });
            })->download('xlsx');*/
            return view('backend.qrcode.exportQrcode', ['data' => $data, 'guid' => $guid, 'name' => $qrcode->company->name]);
        } else {
            return redirect()->route('backend.site.error', ['errorCode' => 404, 'msg' => "Not found request!"]);
        }
    }

    public function active(Request $request)
    {
        $rs = ActiveQrcode::with(['product', 'company', 'partner']);
        $pageSize = ActiveQrcode::PAGE_SIZE;
        $filter = [];
        if ($request->has('pageSize') && $request->pageSize !== $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }
        if ($request->has('guid') && $request->guid !== '') {
            $filter['guid'] = $request->guid;
            $rs = $rs->where('active_qrcode.guid', $request->guid);
        }
        if ($request->has('partner_id') && $request->partner_id !== '') {
            $filter['partner_id'] = $request->partner_id;
            $rs = $rs->where('active_qrcode.partner_id', $request->partner_id);
        }
        if ($request->has('serial') && $request->serial !== '') {
            $filter['serial'] = $request->serial;
            $rs = $rs->where('active_qrcode.serial', $request->serial);
        }
        if ($request->has('product_name') && $request->product_name !== '') {
            $filter['product_name'] = $request->product_name;
            $rs = $rs->join('product', 'product.id', '=', 'active_qrcode.product_id');
            $rs = $rs->where('product.name', 'like', '%' . $request->product_name . '%');
        }
        if ($request->has('start_date') && $request->start_date !== '') {
            $filter['start_date'] = $request->start_date;
            $rs = $rs->where('active_qrcode.active_time', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date !== '') {
            $filter['end_date'] = $request->end_date;
            $rs = $rs->where('active_qrcode.active_time', '<=', $request->end_date);
        }
        if ($request->has('company_id') && $request->company_id != 0) {
            $filter['company_id'] = $request->company_id;
            $rs = $rs->where('active_qrcode.company_id', $filter['company_id']);
            $data['listPartner'] = Partner::getListDropdown($request->company_id);
        } elseif (!Auth::user()->hasAnyRole([1])) {
            $rs = $rs->whereIn('active_qrcode.company_id', Company::getListIdsByAuth());
        }
        $data['listActiveQrcode'] = $rs->orderBy('active_qrcode.id', 'DEC')->paginate($pageSize);
        $data['listCompany'] = Company::getListDropdown();
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
        return view('backend.qrcode.active', $data);
    }

    public function islock(Request $request)
    {
        $rs = ActiveQrcode::with(['product', 'company', 'partner']);
        //$rs = $rs->where('active_qrcode.islock',1);
        $pageSize = ActiveQrcode::PAGE_SIZE;
        $filter = [];
        if ($request->has('pageSize') && $request->pageSize !== $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }
        if ($request->has('guid') && $request->guid !== '') {
            $filter['guid'] = $request->guid;
            $rs = $rs->where('active_qrcode.guid', $request->guid);
        }
        if ($request->has('partner_id') && $request->partner_id !== '') {
            $filter['partner_id'] = $request->partner_id;
            $rs = $rs->where('active_qrcode.partner_id', $request->partner_id);
        }
        if ($request->has('serial') && $request->serial !== '') {
            $filter['serial'] = $request->serial;
            $rs = $rs->where('active_qrcode.serial', $request->serial);
        }
        if ($request->has('product_name') && $request->product_name !== '') {
            $filter['product_name'] = $request->product_name;
            $rs = $rs->join('product', 'product.id', '=', 'active_qrcode.product_id');
            $rs = $rs->where('product.name', 'like', '%' . $request->product_name . '%');
        }
        if ($request->has('start_date') && $request->start_date !== '') {
            $filter['start_date'] = $request->start_date;
            $rs = $rs->where('active_qrcode.active_time', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date !== '') {
            $filter['end_date'] = $request->end_date;
            $rs = $rs->where('active_qrcode.active_time', '<=', $request->end_date);
        }
        if ($request->has('company_id') && $request->company_id != 0) {
            $filter['company_id'] = $request->company_id;
            $rs = $rs->where('active_qrcode.company_id', $filter['company_id']);
            $data['listPartner'] = Partner::getListDropdown($request->company_id);
        } elseif (!Auth::user()->hasAnyRole([1])) {
            $rs = $rs->whereIn('active_qrcode.company_id', Company::getListIdsByAuth());
        }
        $data['listActiveQrcode'] = $rs->orderBy('active_qrcode.islock', 'DEC')->paginate($pageSize);
        $data['listCompany'] = Company::getListDropdown();
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
        return view('backend.qrcode.islock', $data);
    }


    public function islockedit(Request $request, $id)
    {


        $rs = ActiveQrcode::with(['product', 'company', 'partner']);
        $rs = $rs->where('active_qrcode.id', $id);

        $pageSize = ActiveQrcode::PAGE_SIZE;
        $filter = [];

        $data['listActiveQrcode'] = $rs->orderBy('active_qrcode.islock', 'DEC')->paginate($pageSize);
        // $data['listCompany'] = Company::getListDropdown();
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
        //dd($data);
        return view('backend.qrcode.islockedit', $data);
    }
    
   



    public function islockpedit(Request $request, $id)
    {
        $user = ActiveQrcode::find($id);
        if ($user) {
            if ($request->isMethod('post')) {
                /*validate data request*/
                Validator::make($request->all(), [])->setAttributeNames([])->validate();

                try {
                    \DB::beginTransaction();
                    $user->islock = $request->islock;

                    if ($request->message == "") {
                        $user->message = $request->messagep;
                    } else {
                        $user->message = $request->message;
                    }





                    $user->save();
                    \DB::commit();
                    \Session::flash('msg_warranty', "Cập nhật thành công");
                    return redirect()->route('backend.qrcode.islock');
                } catch (Exception $e) {
                    \DB::rollBack();
                    return redirect()->route('backend.site.error');
                }
            }
        } else {
            return redirect()->route('backend.site.error');
        }
    }





    public function previewQrcode()
    {
        $data['listCompany'] = Company::getListDropdown();
        return response()->json(view('backend.qrcode.add_active_qrcode', $data)->render());
    }

    public function renderQrcode(Request $request)
    {
        $rs = Qrcode::select('guid')
            ->where('company_id', $request->company_id)
            ->where('start', '<=', $request->serial)
            ->where('end', '>=', $request->serial)
            ->first();
        if ($rs) {
            return response()->json(['msg' => '', '_src' => 'data:image/png;base64, ' . base64_encode(\QrCodeRender::format('png')->size(200)->generate(config('app.url_qrcode') . Qrcode::PRE_TEXT . $rs->guid . '-' . (Qrcode::encodeSerial($request->serial))))]);
            //   return response('Hello World', 200)    ->header('Content-Type', 'text/plain');

        } else {
            return response()->json(['msg' => 'Không tồn tại số serial này!']);
        }
    }

    private function destroyOrActive($company_id, $serial, $type)
    {
        $rs = Qrcode::where('company_id', $company_id)
            ->where('start', '<=', $serial)
            ->where('end', '>=', $serial)
            ->first();
        $msg = '';
        $status = true;
        $attached_file = [];
        if ($rs) {
            if ($type == 1) {
                $check = ActiveQrcode::where('guid', $rs->guid)->where('serial', $serial)->first();
                if ($check) {
                    $msg = 'Số serial này đã kích hoạt';
                    $status = false;
                } else {
                    $check_product = ProductQrcode::select('product_id', \DB::raw('TIMESTAMPDIFF(MINUTE,NOW(),DATE_ADD(`created_at`, INTERVAL `protected_time_of_tem` MONTH)) as protected_time'))
                        ->where('guid', $rs->guid)
                        ->where('company_id', $company_id)
                        ->where('start', '<=', $serial)
                        ->where('end', '>=', $serial)
                        ->with('product')
                        ->first();
                    if ($check_product) {
                        if ($check_product->protected_time < 0) {
                            $msg = 'Số serial này đã hết hạn kích hoạt!';
                        } else {
                            $active = new ActiveQrcode;
                            $active->guid = $rs->guid;
                            $active->serial = $serial;
                            $active->company_id = $company_id;
                            $active->product_id = $check_product->product_id;
                            $active->active_time = date('Y-m-d H:i:s', time());
                            $active->customer_id = 0;
                            $partner = PartnerQrcode::where('guid', $rs->guid)
                                ->where('company_id', $company_id)
                                ->where('start', '<=', $serial)
                                ->where('end', '>=', $serial)
                                ->with('partner')
                                ->first();
                            if ($partner) {
                                $active->partner_id = $partner->partner_id;
                            }
                            $attached_file = [
                                'ProductQrcode' => $check_product,
                                'PartnerQrcode' => $partner
                            ];
                            $active->save();
                        }
                    } else {
                        $msg = 'Số serial này chưa gán cho sản phẩm nào!';
                        $status = false;
                    }
                }
            } else {
                ActiveQrcode::where('guid', $rs->guid)->where('serial', $serial)->delete();
                $attached_file = $rs;
            }
        } else {
            $msg = 'Không tồn tại số serial này!';
            $status = false;
        }

        $data_return = [
            'msg' => $msg,
            'status' => $status,
            'attached_file' => $attached_file
        ];
        return  $data_return;
    }

    public function destroyOrActiveMutipleQrcode(Request $request)
    {
        // dd($request->all());
        if (!empty($request->get_customer_info) && $request->get_customer_info == 'true') {
            $save_info = true;
            $data_customer = [
                'fullname' => $request->customer_name,
                'email' => $request->customer_email,
                'NBH_sdt' => $request->customer_phone,
                'NBH_dc' => $request->customer_address
            ];
        } else {
            $save_info = false;
        }
        try {
            \DB::beginTransaction();
            $check = true;
            for ($i = $request->start_serial; $i <= $request->end_serial; $i++) {
                if ($check) {
                    $data_return = $this->destroyOrActive($request->company_id, $i, $request->type);

                    $check = $data_return['status'];
                    if (!$data_return['status']) {
                        $serial_error = $i;
                    } elseif ($save_info && $request->type == 1) {
                        $productQrcode = $data_return['attached_file']['ProductQrcode'];
                        $PartnerQrcode = $data_return['attached_file']['PartnerQrcode'];
                        $info = [
                            'fullname' => $request->customer_name,
                            'email' => $request->customer_email,
                            'NBH_sdt' => $request->customer_phone,
                            'NBH_dc' => $request->customer_address,
                            'SP_ten' => $productQrcode['product']['name'],
                            'SP_ma' => $productQrcode['product']['code'],
                            'SP_sr' => $i,
                            'BH_th' => $productQrcode['product']['protected_time'],
                            'BH_time' => date('Y-m-d H:i:s'),
                            'Nha_pp' => $PartnerQrcode['partner']['name'],
                            'idCompany' => $request->company_id,
                            'guid' => $PartnerQrcode['guid'],
                            'price' => $productQrcode['product']['price'],

                            'ngaysinh' => '',
                            'thuonghieu' => '',
                            'city' => '',
                            'ma_dt' => '',
                            'winstatus' => 0
                        ];
                        $warranty = new Warranty;
                        foreach ($info as $key => $value) {
                            $warranty[$key] = $value;
                        }
                        $warranty->save();
                    }elseif ($request->type == 2) {
                        Warranty::where('guid', $data_return['attached_file']['guid'])->where('SP_sr', $i)->delete();
                    }
                } else {
                    break;
                }
            }
            if ($check) {
                if ($request->type == 1) {
                    $return = [
                        'status' => 200,
                        'message' => 'Thực hiện kích hoạt thành công serial từ ' . $request->start_serial . ' tới ' . $request->end_serial . ' !'
                    ];
                } else {
                    $return = [
                        'status' => 200,
                        'message' => 'Thực hiện hủy thành công serial từ ' . $request->start_serial . ' tới ' . $request->end_serial . ' !'
                    ];
                }
            } else {
                $return = [
                    'status' => 90,
                    'message' => $data_return['msg'] . ' serial ' . $serial_error
                ];
            }
            // DB::commit();
        } catch (\Throwable $th) {
            \DB::rollBack();
            dd($th->getMessage());
            $return = [
                'status' => 90,
                'message' => 'Sảy ra lỗi trong quá trình thực hiện thao tác!'
            ];
        }
        return response()->json($return);
    }

    public function destroyOrActiveQrcode(Request $request)
    {
        $data_return = $this->destroyOrActive($request->company_id, $request->serial, $request->type);
        return response()->json(['msg' => $data_return['msg']]);
    }

    public function deleteActiveQrcode(Request $request)
    {
        $id = $request->id;
        $ids = explode(",", $id);
        $qrcode = ActiveQrcode::find($id);
        ActiveQrcode::destroy($ids);



        \DB::table('warranty')
            ->where('guid', $qrcode->guid)
            ->where('SP_sr', $qrcode->serial)
            ->delete();




        \Session::flash('msg_qrcode', "Xóa thành công");
        if ($request->has('guid') && $request->guid != '')
            return redirect()->route('backend.qrcode.active', ['guid' => $request->guid]);
        else
            return redirect()->route('backend.qrcode.active');
    }

    public function getDropdownPartner($company_id)
    {
        return response()->json(Partner::getListDropdown($company_id));
    }
}
