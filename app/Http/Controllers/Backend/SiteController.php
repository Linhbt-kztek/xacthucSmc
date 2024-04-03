<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\User;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Models\Backend\Company;
use App\Http\Models\Backend\Partner;
use App\Http\Models\Backend\Product;
use App\Http\Models\Backend\Qrcode;
use App\Http\Models\Backend\Warranty;
use App\Http\Models\Backend\ActiveQrcode;



class SiteController extends Controller
{
    public function login(Request $request) 
    {
        if($request->isMethod("post")) {
    		/*validate data request*/
            Validator::make($request->all(), [
                'password' => 'required',
                'email' => 'required | email'              
            ])->validate();

            $user['email'] = $request->email;
            $user['password'] = $request->password;
            $remember_token = ($request->remember_token != null) ? true : false;
            if(Auth::attempt($user, $remember_token)) {
            	return redirect()->route('backend.site.index');
            } else {
            	return redirect()->route('backend.site.vLogin')->withErrors("Email or password incorect or Account was locked!");
            }
    	}
    	return view('backend.site.login');
    }

    public function index() 
    {
         $a="7";
         $idUser=Auth::user()->id;
         if($idUser==1)
             {
                $companyID=0;
                $company =  Company::count();
                $partner =  Partner::count();
                $product =  Product::count();
                $qrcode =   Qrcode::count();
                $rsstart = Qrcode::select('*')->sum('start');
                $rsend = Qrcode::select('*')->sum('end');
                $totalcode=$rsend-$rsstart+$qrcode;
                
                $warranty = Warranty::count();
                
                $activeqrcode=ActiveQrcode::count();
                $user = User::count();
                
             }
             else
             {
                $companyID= Auth::user()->company->id;
             }
           
           if(!Auth::user()->hasAnyRole([1])) 
           {
               
           $partner = Partner::where('company_id', $companyID)->count();
           $product = Product::where('company_id', $companyID)->count();
           $qrcode = Qrcode::where('company_id', $companyID)->count();
           
           $warranty =Warranty::where('idCompany', $companyID)->count();
           $activeqrcode=ActiveQrcode::where('company_id', $companyID)->count();
            $company=1;
            $user=1;
             $rsstart = Qrcode::where('company_id', $companyID)->sum('start');
                $rsend = Qrcode::where('company_id', $companyID)->sum('end');
                $totalcode=$rsend-$rsstart+$qrcode;
            
           
           }
        
        
        
        
        
        
             
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
        $pageSize = Warranty::PAGE_SIZE;
        $filter = [];
    
        
         if(!Auth::user()->hasAnyRole([1])) {
            $rs = $rs->where('idCompany', $companyID);
        }
        
        
        $data['listHistory'] =  $rs->orderBy('id','DESC')->paginate($pageSize);;
        $data['filter'] = $filter;
        $data['pageSize'] = 10; 
        
      
      /// Xử lý thời gian thông báo bảo hành //////////
                                                  $row  = $rs->first();    
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
      
       $idUser=Auth::user()->id;
         if($idUser==1)
             {
                $companyID=0;
             }
             else
             {
                $companyID= Auth::user()->company->id;
             }
        
        $rsh = ActiveQrcode::select('*');
        $pageSize = ActiveQrcode::PAGE_SIZE;
        $filter = [];
    
        
         if(!Auth::user()->hasAnyRole([1])) 
         {
           // $rsh = $rsh->where('company_id', $companyID);
         }
        
        
        $datas['listHistoryh'] =  $rsh->orderBy('id','DESC')->paginate($pageSize);;
        $datas['filter'] = $filter;
        $datas['pageSize'] = 10; 
        //dd($datas);

        
    	return view('backend.site.index',$data,['timebh'=>$timebh, 'partner'=>$partner,'product'=>$product,'qrcode'=>$qrcode,'warranty'=>$warranty, 'company'=> $company,'user'=> $user,'activeqrcode'=>$activeqrcode,'totalcode'=>$totalcode]);
    }
    

    public function error($errorCode, $msg) 
    {
    	return view('backend.site.error', ['errorCode'=>$errorCode, 'msg'=>$msg]);
    }

    public function logout()
    {
    	Auth::guard('admin')->logout();
        return redirect()->route('backend.site.vLogin');
    }

    public function resetPass(Request $request)
    {
    	if($request->isMethod("post")) {
            /*validate data request*/
            $va = Validator::make($request->all(), [
                'idmsv' => 'required',
                'email' => 'required|email'              
            ]);
            if($va->fails()) {
                return redirect()->route('backend.site.vResetPass')->withErrors("Email và Mã sinh viên không được để trống!");
            }
            $check = User::where('email', $request->email)
                            ->where('user_id', $request->idmsv)
                            ->where('social_type', '<>', User::SUPPER_USER)
                            ->where('status', User::STATUS_ACTIVE)
                            ->first();
            if($check) {
                $check->password = bcrypt('abc123');
                $check->save();
                $mail = new PHPMailer(true);
                try{
                    $mail->isSMTP();     
                    $mail->CharSet = "utf-8";
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'utmapp2018@gmail.com';                 // SMTP username
                    $mail->Password = 'chanhniem';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    //Recipients
                    $mail->setFrom('utmapp2018@gmail.com', 'UTM System');
                    $mail->addAddress($request->email);

                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Reset Password';
                    $mail->Body    = "Mật khẩu mới của bạn là: <strong>abc123</strong><br>Vui lòng thay đổi mật khẩu để bảo mật thông tin.";

                    $mail->send();
                    \Session::flash('msg_changePass', "Chúng tôi đã gửi mật khẩu mới tới Email của bạn. Vui lòng mở Email để cập nhật!");
                } catch (Exception $e) {
                    return redirect()->route('backend.site.vResetPass')->withErrors($mail->ErrorInfo);
                }
            } else {
                return redirect()->route('backend.site.vResetPass')->withErrors("Email hoặc Mã sinh viên không đúng hoặc Tài khoản đang bị khóa!");
            }
    	}
    	return view('backend.site.resetPass');
    }

    public function uploadImageContent(Request $request)
    {
        if($request->isMethod("post")) {
            if ($request->hasFile('file')) {
                /*upload file to public/upload/content*/
                $path = $request->file('file')->store(
                    'content/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time()), 'upload'
                );
                /*if(file_exists($product->introimage)) {
                    unlink($product->introimage);
                }*/
                return response()->json(asset('upload/'.$path));
            }
        }
    }
}
