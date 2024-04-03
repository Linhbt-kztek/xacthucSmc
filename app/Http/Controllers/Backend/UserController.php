<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\User;
//use App\Http\Models\Backend\Role;
//use App\Http\Models\Backend\RoleUser;

class UserController extends Controller
{
    public function index(Request $request) 
    {
        $rs = User::select('users.*')
                    ->where('is_admin', User::IS_COMPANY);
        
        if($request->has('fullname') == true && $request->fullname !== "") {
            $filter['fullname'] = $request->fullname;
            $rs = $rs->whereRaw("LOWER(fullname) LIKE CONCAT('%', CONVERT('".strtolower($filter['fullname'])."', BINARY),'%')");
        }
        
        
        if($request->has('email') == true && $request->email !== "") {
            $filter['email'] = $request->email;
            $rs = $rs->whereRaw("LOWER(email) LIKE CONCAT('%', CONVERT('".strtolower($filter['email'])."', BINARY),'%')");
            
        }

        $pageSize = User::PAGE_SIZE;
        $filter = [];
        if($request->has('pageSize') && $request->pageSize != $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }
        $data['listUser'] = $rs->orderBy('users.id','DEC')->paginate($pageSize);
         
        
        
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
        $data['type'] = User::$TYPE;
        
        return view('backend.user.index', $data);
    }

    public function add(Request $request) 
    {
        if($request->isMethod('post')) {
            /*validate data request*/
            Validator::make($request->all(), [
                'fullname' => 'required|max:255',
                'email' => 'required | email|max:150',
                'is_admin' => 'required'        
            ])->setAttributeNames([
                'fullname' => 'Tên người dùng',
                'email' => 'Email',
                'is_admin' => 'Loại user'
            ])->validate();
            if(User::where('email', $request->email)->first()) {
                return redirect()->route('backend.user.vAdd')->withErrors(['email' => 'Email đã tồn tại!']);
            }
            try {
                \DB::beginTransaction();
                $user = new User;
                $user->fullname = $request->fullname;
                $user->email = $request->email;
                $user->tel = $request->tel;
                $user->address = $request->address;
                $user->status = User::STATUS_ACTIVE;
                $user->password = bcrypt("smartcheck123@");
                /*$user->role_id = $request->role_id;*/
                $user->is_admin = $request->is_admin;
                $user->save();
                \DB::commit();
                \Session::flash('msg_user', "Thêm mới thành công");
                return redirect()->route('backend.user.index');
            } catch (Exception $e) {
                \DB::rollBack();
                return redirect()->route('backend.site.error');
            }
        }     
        /*get all roles*/
        /*$data['listRole'] = Role::select('id', 'name')->orderBy('id','ASC')->get();*/
        $data['type'] = User::$TYPE;
        return view('backend.user.add', $data);
    }

    public function edit(Request $request, $id) 
    {
        $user = User::find($id);
        if($user) {
            if($request->isMethod('post')) {
                /*validate data request*/
                Validator::make($request->all(), [
                    'fullname' => 'required|max:255',
                    'email' => 'required | email|max:150',
                    'is_admin' => 'required',
                     'newPass' => '',
                'newPass_confirmation' => 'required | same:newPass'
                ])->setAttributeNames([
                    'fullname' => 'Tên người dùng',
                    'email' => 'Email',
                    'is_admin' => 'Loại user',
                     'newPass' => 'Mật khẩu mới',
                'newPass_confirmation' => 'Xác nhận mật khẩu'
                ])->validate();
                if(User::where('email', $request->email)->where('email', '<>', $user->email)->first()) {
                    return redirect()->route('backend.user.vEdit',['id'=>$user->id])->withErrors(['email' => 'Email đã tồn tại!']);
                }
                try {
                    \DB::beginTransaction();
                    $user->fullname = $request->fullname;
                    $user->email = $request->email;
                    $user->tel = $request->tel;
                    $user->address = $request->address;
                    $user->status = $request->status;
                    $user->password = bcrypt($request->newPass);
                    /*$user->role_id = $request->role_id;*/
                    $user->is_admin = $request->is_admin;
                    $user->save();
                    \DB::commit();
                    \Session::flash('msg_user', "Cập nhật thành công");
                    return redirect()->route('backend.user.index');
                } catch (Exception $e) {
                    \DB::rollBack();
                    return redirect()->route('backend.site.error');
                }
            }
            /*get all roles*/
            /*$data['listRole'] = Role::select('id', 'name')->orderBy('id','ASC')->get();*/
            $data['listStatus'] = User::$STATUS;
            $data['type'] = User::$TYPE;
            $data['model'] = $user;
            return view('backend.user.edit', $data);
        } else {
            return redirect()->route('backend.site.error');
        }
    }

    public function profile(Request $request) 
    {
        if($request->isMethod("post")) {
            /*validate data request*/
            Validator::make($request->all(), [
                'fullname' => 'required',
                // 'email' => 'required | email'            
            ])->setAttributeNames([
                'fullname' => 'Tên người dùng',
                // 'email' => 'Email'
            ])->validate();
            // if(User::where('email', $request->email)->where('email', '<>', Auth::user()->email)->first()) {
            //     return redirect()->route('backend.user.vAdd')->withErrors(['email' => 'Email đã tồn tại!']);
            // }
            $user = Auth::user();
            $user->fullname = $request->fullname;
            // $user->email = $request->email;
            $user->tel = $request->tel;
            $user->address = $request->address;
            if ($request->hasFile('introimage')) {
                /*upload file to public/upload/products*/
                $path = $request->file('introimage')->store(
                    'avatar/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time()), 'upload'
                );
                if(file_exists($user->introimage)) {
                    unlink($user->introimage);
                }
                $user->introimage = 'upload/'.$path;
            }
            $user->save();
            \Session::flash('msg_editProfile', "Update profile susscess!");
        }
        return view('backend.user.profile');
    }

    public function changePass(Request $request) 
    {
        if($request->isMethod("post")) { 
            /*validate data request*/
            Validator::make($request->all(), [
                'oldPass' => 'required',
                'newPass' => 'required',
                'newPass_confirmation' => 'required | same:newPass'
            ])->setAttributeNames([
                'oldPass' => 'Mật khẩu hiện tại',
                'newPass' => 'Mật khẩu mới',
                'newPass_confirmation' => 'Xác nhận mật khẩu'
            ])->validate();
            if(!Hash::check($request->oldPass, Auth::user()->password)) {
                return redirect()->route('backend.user.profile')->withErrors(['oldPass' => 'Old password is not correct']);
            }
            $user = Auth::user();
            $user->password = bcrypt($request->newPass);
            $user->save();
            \Session::flash('msg_changePass', "Change password susscess!");
        }
        return view('backend.user.profile');
    }

    public function reverseStatus(Request $request) 
    {
        $response = [];
        $user = User::find($request->id);
        if($user) {
            if($user->status == User::STATUS_ACTIVE) {
                $response['rm'] = 'fa-check-circle';
                $response['add'] = 'fa-question';
                $user->status = User::STATUS_HIDE;
            } else {
                $response['add'] = 'fa-check-circle';
                $response['rm'] = 'fa-question';
                $user->status = User::STATUS_ACTIVE;
            }
            $user->save();
        } else {
            $response['error'] = true;
        }
        
        return response()->json($response);
    }

    public function delete($id) 
    {
        $ids = explode(",", $id);
        foreach ($ids as $id) {
            $user = User::find($id);
            if(file_exists($user->introimage)) {
                unlink($user->introimage);
            }
            $user->delete();
        }
        \Session::flash('msg_user', "Xóa thành công");
        return redirect()->route('backend.user.index');
    }
}
