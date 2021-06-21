<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $title = "User";

    public function __construct()
    {
        $this->middleware(['role:super_admin','permission:user_handling']);
    }

    public function index()
    {
        try {
            $users = User::all();
            $params = [
                'users' => $users,
                'title' => $this->title,
            ];
            return view('admin.user.index')->with($params);
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
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'employee_id' => 'required|unique:users,employee_id',
                'password' => 'required|required_with:password_confirmation|confirmed|min:8|max:16',
                'password_confirmation' => 'required',
                'role' => 'required',
            ]);
            $user = new User();
            $name = $request->name;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->employee_id = $request->employee_id;
            $user->save();
            $user->assignRole($request->role);

            return redirect()->route('user.index')->with('success_msg', 'Successfully added new user ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }

    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            $employees = Employee::all();
            $roles = Role::all();
            $params = [
                'user' => $user,
                'employees' => $employees,
                'roles' => $roles,
                'title' => $this->title,
            ];
            return view('admin.user.show')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'employee_id' => 'required|unique:users,employee_id',
                'role' => 'required',
            ]);
            $user = User::findOrFail($id);
            $name = $user->name;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->employee_id = $request->employee_id;
            $user->save();
            $user->syncRoles($request->role);

            return back()->with('success_msg', 'Successfully updated user ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function delete($id){
        $params = [
            'id'=>$id,
            'title'=>$this->title,
        ];
        return view('admin.user.delete')->with($params);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $name = $user->name;
            $roles = Role::all();
            foreach ($roles as $data) {
                if ($user->hasRole($data->id)) {
                    $user->removeRole($data->id);
                }
            }
            $user->delete();
            return redirect()->route('user.index')->with('success_msg', 'Successfully deleted user ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function create()
    {
        try {
            $employees = Employee::all();
            $roles = Role::all();
            $params = [
                'employees' => $employees,
                'roles' => $roles,
                'title' => $this->title,
            ];
            return view('admin.user.create')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }
}
