<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Models\Backend\Role;
use App\Http\Models\Backend\Permission;
use App\Http\Models\Backend\RolePermission;

class RoleController extends Controller
{
    public function index(Request $request)
    {
    	$rs = Role::select("*");

        $pageSize = Role::PAGE_SIZE;
        $filter = [];
        if($request->has('pageSize') && $request->pageSize != $pageSize) {
            $filter['pageSize'] = $request->pageSize;
            $pageSize = $request->pageSize;
        }

        if($request->has('name') == true && $request->name != "") {
            $filter['name'] = $request->name;
            $rs = $rs->where('name', 'like', '%'.$filter['name'].'%');
        }
        
        $data['listRole'] = $rs->orderBy('id','ASC')->paginate($pageSize);
        $data['filter'] = $filter;
        $data['pageSize'] = $pageSize;
    	return view('backend.role.index', $data);
    }

    public function add(Request $request)
    {
    	if($request->isMethod('post')) {
            /*validate data request*/
            Validator::make($request->all(), [
                'name' => 'required|max:255',
                'permission' => 'required | array'
            ])->validate();
            try {
                \DB::beginTransaction();
                $role = new Role;
                $role->name = $request->name;
                if($role->save()) {
                    $data_insert = [];
                    foreach ($request->permission as $permission_id) {
                        $item = [];
                        $item['role_id'] = $role->id;
                        $item['permission'] = $permission_id;
                        array_push($data_insert, $item);
                    }
                    RolePermission::insert($data_insert);
                }
                \DB::commit();
                return redirect()->route('backend.role.index');
            } catch(\Exception $e){
                \DB::rollBack();
                return redirect()->route('backend.role.vAdd')->withErrors($e->getMessage());
            }
        }
        $data['listPermission'] = Permission::orderBy('name', 'ASC')->get();
        return view('backend.role.add', $data);
    }

    public function edit(Request $request, $id)
    {
    	$role = Role::find($id);
        if($role) {
            if($request->isMethod('post')) {
                /*validate data request*/
                Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'permission' => 'required | array'
                ])->validate();
                try {
                    \DB::beginTransaction();
    	            $role->name = $request->name;
    	            if($role->save()) {
                        RolePermission::where('role_id', $role->id)->delete();
                        $data_insert = [];
                        foreach ($request->permission as $permission_id) {
                            $item = [];
                            $item['role_id'] = $role->id;
                            $item['permission'] = $permission_id;
                            array_push($data_insert, $item);
                        }
                        RolePermission::insert($data_insert);
                    }
                    \DB::commit();
                    return redirect()->route('backend.role.index');
                } catch(\Exception $e){
                    \DB::rollBack();
                    return redirect()->route('backend.role.vEdit')->withErrors($e->getMessage());
                }
            }
            $data['per_selected'] = Permission::join('role_permission', 'role_permission.permission', '=', 'permission.name')
                                                ->where('role_permission.role_id', $id)
                                                ->orderBy('permission.name')
                                                ->get();
            $data_not_in = [];
            foreach ($data['per_selected'] as $item) {
                $data_not_in[] = $item->name;
            }
            $per_unselected = Permission::select('*');
            if(count($data_not_in) > 0) {
                $per_unselected = $per_unselected->whereNotIn('name', $data_not_in);
            }
            $data['per_unselected'] = $per_unselected->orderBy('name')->get();
            $data['model'] = $role;
            return view('backend.role.edit', $data);
        } else {
            return redirect()->route('backend.site.error');
        }
    }

    public function delete($id) 
    {
        $ids = explode(",", $id);
        foreach ($ids as $id) {
            $role = Setting::find($id);
            $role->delete();
        }
        \Session::flash('msg_role', "Xóa thành công");
        return redirect()->route('backend.role.index');
    }
}
