<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public $title = "Permissions";

    public function __construct()
    {
        $this->middleware(['role:super_admin|it_admin','permission:permission_handling']);
    }

    public function index()
    {
        try {
            $permissions = Permission::all();
            $params = [
                'permissions' => $permissions,
                'title' => $this->title,
            ];
            return view('admin.permission.index')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:permissions,name',
                'description' => 'required',
            ]);

            $name = $request->name;
            $permission = Permission::create(
                [
                    'name' => $request->name,
                    'description' => $request->description,
                ]
            );

            return back()->with('success_msg', 'Successfully added new permission ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }

    }

    public function show($id)
    {
        try {
            $permission = Permission::findById(decrypt($id));
            $params = [
                'permission' => $permission,
                'title' => $this->title,
            ];
            return view('admin.permission.show')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $permission = Permission::findById(decrypt($id));

            if ($permission->name != $request->name or !$request->name) {
                $this->validate($request, [
                    'name' => 'required|unique:permissions,name',
                ]);
            }
            $this->validate($request, [
                'description' => 'required',
            ]);
            $name = $permission->name;
            $permission->name = $request->name;
            $permission->description = $request->description;
            $permission->save();
            return back()->with('success_msg', 'Successfully updated permission ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function delete($id)
    {
        $params = [
            'id'=> decrypt($id),
            'title'=>$this->title,

        ];
        return view('admin.permission.delete')->with($params);
    }

    public function destroy($id)
    {
        try {
            $permission = Permission::findById(decrypt($id));
            $name = $permission->name;
            $permission->delete();
            return redirect()->route('permission.index')->with('success_msg', 'Successfully deleted permission ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function create()
    {
        $params = [
            'title' => $this->title
        ];
        return view('admin.permission.create')->with($params);
    }

}
