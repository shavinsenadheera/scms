<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public $title = "Roles";

    public function __construct(){
        $this->middleware(['role:super_admin|it_admin','permission:role_handling']);
    }

    public function index(){
        try {
            $roles = Role::all();
            $permissions = Permission::all();
            $params = [
                'roles' => $roles,
                'permissions' => $permissions,
                'title' => $this->title,
            ];
            return view('admin.role.index')->with($params);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:roles,name',
                'description' => 'required',
                'permission' => 'required',
            ]);
            $permissions = $request->permission ? $request->permission : [];
            $name = $request->name;
            $role = Role::create([
                'name' => $request->name,
                'description' => $request->description
            ]);
            $role->syncPermissions($permissions);
            return back()->with('success_msg', 'Successfully added new role ' . $name);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function show($id)
    {
        try {
            $role = Role::findById(decrypt($id));
            $permissions = Permission::all();
            $gotPermissions = $role->permissions()->allRelatedIds()->toArray();
            $params = ['role' => $role, 'permissions' => $permissions, 'gotPermissions' => $gotPermissions, 'title' => $this->title];
            return view('admin.role.show')->with($params);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $role = Role::findById($id);
            if ($role->name != $request->name or !$request->name) {
                $request->validate(['name' => 'required|unique:roles,name']);
            }
            $this->validate($request, [
                'description' => 'required',
            ]);
            $name = $role->name;
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
            $gotPermissions = $role->permissions()->allRelatedIds()->toArray();
            foreach ($gotPermissions as $data) {
                $role->revokePermissionTo($data);
            }
            $role->syncPermissions($request->permission);
            return back()->with('success_msg', 'Successfully updated role ' . $name);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function delete($id)
    {
        $params = ['id'=>$id, 'title'=>$this->title];
        return view('admin.role.delete')->with($params);
    }

    public function destroy($id)
    {
        try {
            $role = Role::findById($id);
            $name = $role->name;
            $gotPermissions = $role->permissions()->allRelatedIds()->toArray();
            foreach ($gotPermissions as $data) {
                $role->revokePermissionTo($data);
            }
            $role->delete();
            return redirect()->route('role.index')->with('success_msg', 'Successfully deleted role ' . $name);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function create()
    {
        try {
            $permissions = Permission::all();
            $params = ['permissions' => $permissions, 'title' => $this->title,];
            return view('admin.role.create')->with($params);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

}
