<?php

namespace App\Http\Controllers\Backend;
use Carbon\Carbon;
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
use App\Http\Models\Backend\Warranty;
use App\Http\Models\Backend\Warrantyhistory;
use Excel;


class WarrantyController extends Controller
{
 public function index(Request $request) 
    {   
         $idUser=Auth::user()->id;
         if($idUser==1)
             {
                $companyID=0;
             }
             else
             {
                $companyID= Auth::user()->company->id;
               
             }
        //return $companyID;
        $rs = Warranty::select('*');
        
        $warrantytotal = Warranty::count();
        $pageSize = Warranty::PAGE_SIZE;
        $filter = [];
        
        
         if(!Auth::user()->hasAnyRole([1])) {
             if ($companyID==32)
             {
                $rs = $rs->whereIn('idCompany', [$companyID,123]);
                $warrantytotal =Warranty::whereIn('idCompany', [$companyID,123])->count();
             }
             else
             {
                 $rs = $rs->where('idCompany', $companyID);
                 $warrantytotal =Warranty::where('idCompany', $companyID)->count();
             }
            
            
        }
        
        if($request->has('pageSize') && $request->pageSize != $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }
        
         if($request->has('fullname') == true && $request->fullname !== "") {
            $filter['fullname'] = $request->fullname;
            $rs = $rs->whereRaw("LOWER(fullname) LIKE CONCAT('%', CONVERT('".strtolower($filter['fullname'])."', BINARY),'%')");
        }
        
        
        if($request->has('NBH_sdt') == true && $request->NBH_sdt !== "") {
            $filter['NBH_sdt'] = $request->NBH_sdt;
            $rs = $rs->whereRaw("LOWER(NBH_sdt) LIKE CONCAT('%', CONVERT('".strtolower($filter['NBH_sdt'])."', BINARY),'%')");
            
        }
         if($request->has('Nha_pp') == true && $request->Nha_pp !== "") {
            $filter['Nha_pp'] = $request->Nha_pp;
            $rs = $rs->whereRaw("LOWER(Nha_pp) LIKE CONCAT('%', CONVERT('".strtolower($filter['Nha_pp'])."', BINARY),'%')");
            
        }
        
         if($request->has('SP_sr') == true && $request->SP_sr !== "") {
            $filter['SP_sr'] = $request->SP_sr;
            $rs = $rs->whereRaw("LOWER(SP_sr) LIKE CONCAT('%', CONVERT('".strtolower($filter['SP_sr'])."', BINARY),'%')");
            
        }
        
         
       /////////////ĐANG BỊ LỖI //////////////////////////////////////////////////////////////////
       
       if($request->has('start_date') && $request->start_date !== '') {
            $filter['start_date'] = $request->start_date;
            $rs = $rs->where('BH_time', '>=',$request->start_date);
        }
        if($request->has('end_date') && $request->end_date !== '') {
            $filter['end_date'] = $request->end_date;
            $rs = $rs->where('BH_time', '<=',$request->end_date);
        }
        
       
       
        /////////////////////////////////////////////////////////////////////////////////////////
        
        
        
        $data['listHistory'] =  $rs->orderBy('id','DESC')->paginate($pageSize);;
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize; 
        
      
      /// Xử lý thời gian thông báo bảo hành //////////
     
                                                //  $row  =  $rs->orderBy('id','DESC')->get(); 
                                                //  $row = Warranty::select('*');
                                                    $rs=$rs->first();
                                                  if(!$rs)
                                                  {
                                                  $timebh="...";
                                                  }
                                                  else
                                                  {
                                                      /*
                                                  $today = date("d/m/Y");
                                                  $date1 = date("Y-m-d"); 
                                                  $date2 = $row->BH_time;
                                                  $first_date = strtotime(date("Y-m-d"));
                                                  $second_date = strtotime($date2);
                                                  $datediff = abs($first_date - $second_date);
                                                  $day = $row->BH_th*30 - floor($datediff / (60*60*24));
                                                  
                                                  */
                                                  
                                                  $today = date("d/m/Y");
                                                  $date1 = date("Y-m-d"); 
                                                  $date2 = $rs->BH_time;
                                                  $date3 = $rs->BH_th;
                                                  $t=abs(strtotime($date1)-strtotime($date2));
                                                  $day= floor($t/  (60 * 60 * 24));
                                                  $date3=$date3*30;
                                                  $ngayconlai=$date3-$day;
                                                  
                                                   if ($ngayconlai<0)
                                                  {
                                                      $ngayconlai=0;
                                                  }
                                                 // dd($day);
                                                  
                                                  if($day <= 0 )
                                                      {
                                                      $timebh= "Đã hết hạn bảo hành.";
                                                             $cl = "cl()"; 
                                                      }
                                                  else
                                                      {
                                                         $timebh =$ngayconlai;
                                                      
                                                      }
                                                  }
      
     
      ///////////////////////////////////////////////
      
       
        return view('backend.warranty.home', $data,  ['timebh'=>$timebh,'warrantytotal'=>$warrantytotal]);
    	

    }

 public function history(Request $request,$id) 
    {  
         $rs = Warrantyhistory::select('*');
         $pageSize = Warrantyhistory::PAGE_SIZE;
        
        $rs = $rs->where('warrantyid', $id);
        $data['listHistory'] = $rs->orderBy('id','DESC')->paginate($pageSize);
                //////////// Lọc bảng Warranty///////////
         $rsw = Warranty::select('*');
         $rsw = $rsw->where('id', $id);
      
         
         $data['warrantyname'] = $rsw->orderBy('id','DESC')->paginate($pageSize);
      /// Xử lý thời gian thông báo bảo hành //////////
                                                  $row  = $rsw->first();   
                                                   if(!$row)
                                                  {
                                                  $timebh="...";
                                                  }
                                                  else
                                                  {
                                                  $today = date("d/m/Y");
                                                  $date1 = date("Y-m-d"); 
                                                  $date2 = $row->BH_time;
                                                  $first_date = strtotime(date("Y-m-d"));
                                                  $second_date = strtotime($date2);
                                                  $datediff = abs($first_date - $second_date);
                                                  $day = $row->BH_th*30 - floor($datediff / (60*60*24));
                                                  if($day <= 0 )
                                                      {
                                                      $timebh= "Đã hết hạn bảo hành.";
                                                             $cl = "cl()"; 
                                                      }
                                                  else
                                                      {
                                                         $timebh =$row->BH_th*30 - floor($datediff / (60*60*24));
                                                      
                                                      }
                                                      
                                                  }
       ///////////////////////////////////////////////
    
        return view('backend.warranty.history', $data, ['timebh'=>$timebh]);
      
    }
    
    public function viewadd()
    {
        $warrantyid=$_GET['warrantyid'];
        return view('backend.warranty.add',['warrantyid'=>$warrantyid]);  
    }
   
    public function addhistory(Request $request) 
     {
           if($request->isMethod('post')) {
        	/*validate data request*/
            Validator::make($request->all(), [
                'content' => 'required',
                'process' => 'required'
            ])->setAttributeNames([
                'content' => 'Yêu cầu',
                'proces' => 'Xử lý',
                'price' => 'Giá'
            ])->validate();
            $today=date("Y/m/d");
            $warrantyhistory = new warrantyhistory;
            $warrantyhistory->content = $request->content;
            $warrantyhistory->warrantyid = $request->warrantyid;
            $warrantyhistory->process = $request->process;
            $warrantyhistory->price = $request->price;
            $warrantyhistory->warrantydate = $today;
            $warrantyhistory->save();
            \Session::flash('msg_warranty', "Thêm mới thành công");
            $warrantyid=$request->warrantyid;
            return redirect()->route('backend.warranty.history',[$warrantyid]);
            
        }
      
        
    }
   
    public function delhistory(Request $request, $id) 
    {
       $ids = explode(",", $id);
        foreach ($ids as $id) {
            $user = warrantyhistory::find($id);
            $user->delete();
        }
        \Session::flash('msg_warrantyhistory', "Xóa thành công");
         return back();
        //return redirect()->route('backend.user.index');
       
       
    }
    
    
    

/* ----------------------------- */

  

public function edit(Request $request, $id) 
    {
        $user = Warranty::find($id);
        if($user) {
            if($request->isMethod('post')) {
                /*validate data request*/
                Validator::make($request->all(), [
                    'BH_time' => 'required|max:255',
                    'fullname' => 'required',
                    'NBH_sdt' => 'required',
                    'NBH_dc' => 'required',
                ])->setAttributeNames([
                    'BH_time' => 'Tên thời gian',
                    
                ])->validate();
               
                try {
                    \DB::beginTransaction();
                    $user->BH_time = $request->BH_time;
                    $user->fullname = $request->fullname;
                    $user->NBH_dc = $request->NBH_dc;
                    $user->NBH_sdt = $request->NBH_sdt;
                    $user->email = $request->email;
                    
                    
                  
                    $user->save();
                    \DB::commit();
                    \Session::flash('msg_warranty', "Cập nhật thành công");
                    return redirect()->route('backend.warranty.history',[$id]);
                } catch (Exception $e) {
                    \DB::rollBack();
                    return redirect()->route('backend.site.error');
                }
            }
          
          
          
        } else {
            return redirect()->route('backend.site.error');
        }
    }

    
    
    public function downloadExcel()
    {
    $idUser=Auth::user()->id;
     $data = Warranty::get(['id','SP_ten','price','SP_ma','SP_sr', 'BH_time','fullname','NBH_sdt','NBH_dc','email','Nha_pp','ma_dt','winname','idCompany']);
         if($idUser!=1)
             {
                $companyID= Auth::user()->company->id;
                $data = $data->where('idCompany', $companyID);
                
             }
             
            $data->toArray();
        
		return Excel::create('DanhSachBaoHanh', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download()->allFields()->except('guid');
	}
 

}