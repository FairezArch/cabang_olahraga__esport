<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Menus_web;

class RolesController extends Controller
{
    
    public function __construct()
    {
        # code...
        $this->middleware(['permission:roles-list|roles-create|roles-edit|roles-delete']);
    }

    public function index()
    {
        $roles = Role::paginate(5);
        return view('pages.roles.index',compact('roles'));
    }

    public function create(){
        $parent_menu = Menus_web::get();//DB::table('menus_webs')->get();
        $permissions = Permission::get();
         
        return view('pages.roles.add',compact('parent_menu','permissions'));
    }

    public function store(Request $request)
    {
        # code...

        $rules = [
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array',
        ];
  
        $messages = [
            'name.required'         => 'Nama role wajib diisi',
            'permission.required'   => 'Permission wajib dipilih',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permission);
    
        return redirect()->route('roles')
                        ->with('success','Role created successfully');
    }

    public function show($id)
    {
        # code...
        $role = Role::find($id);
        $parent_menu = Menus_web::get();
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('pages.roles.edit',compact('role','parent_menu','permissions','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'permission' => 'required|array',
        ];
  
        $messages = [
            'name.required'         => 'Nama role wajib diisi',
            'permission.required'   => 'Permission wajib dipilih',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles')
                        ->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles')
                        ->with('success','Role deleted successfully');
    }
}
