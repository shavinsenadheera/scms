<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller{
    public $title = "User";

    public function __construct(){
        $this->middleware(['role:super_admin|it_admin','permission:user_handling']);
    }

    public function index(){
        try {
            $users = User::all();
            $params = ['users' => $users, 'title' => $this->title];
            return view('admin.user.index')->with($params);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function create(){
        try {
            $employees = Employee::all();
            $roles = Role::all();
            $params = ['employees' => $employees, 'roles' => $roles, 'title' => $this->title,];
            return view('admin.user.create')->with($params);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function store(Request $request){
        try {
            $request->validate([
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
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function show($id){
        try {
            $user = User::findOrFail(decrypt($id));
            $employees = Employee::all();
            $roles = Role::all();
            $params = ['user' => $user, 'employees' => $employees, 'roles' => $roles, 'title' => $this->title];
            return view('admin.user.show')->with($params);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'name'          => 'required',
                'email'         => 'required|email',
                'employee_id'   => 'required',
                'role'          => 'required',
            ]);
            $user = User::findOrFail(decrypt($id));
            if($request->employee_id!=$user->employee_id){$request->validate(['employee_id' => 'required|unique:users,employee_id']);}
            if($request->email!=$user->email) { $request->validate(['email' => 'required|email|unique:users,email']);}
            $name = $user->name;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->employee_id = $request->employee_id;
            $user->save();
            $user->syncRoles($request->role);
            return back()->with('success_msg', 'Successfully updated user ' . $name);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function delete($id){
        $params = ['id'=>$id, 'title'=>$this->title];
        return view('admin.user.delete')->with($params);
    }

    public function destroy($id){
        try {
            $user = User::findOrFail($id);
            $name = $user->name;
            $roles = Role::all();
            foreach ($roles as $data) {
                if ($user->hasRole($data->id)) {$user->removeRole($data->id);}
            }
            $user->delete();
            return redirect()->route('user.index')->with('success_msg', 'Successfully deleted user ' . $name);
        }catch (ModelNotFoundException $exception){
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }


    public function changeProfile(){
        return view('generalPages.profileChange');
    }

    public function updateProfile(Request $request, $id){
        try {
            if($request->name || $request->email) {
                if($request->name){$request->validate(['name'  => 'string']);}
                if($request->email){$request->validate(['email'  => 'email']);}
                $user = User::findOrFail(Auth::id());
                $user->name = $request->name && $request->name;
                $user->email = $request->email && $request->email;
                $user->save();
                return back()->with('success_msg', 'Successfully updated user ' . $user->name);
            } else {
                return back()->with('error_msg', 'Please enter what do you want to change!');
            }
        } catch(ModelNotFoundException $exception) {
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function updatePassword(Request $request, $id){
        try {
            $request->validate([
               'current_password'       => 'required',
               'new_password'           => 'required|min:8|max:16',
               'password_confirmation'  => 'required',
           ]);
            $user = User::findOrFail(Auth::id());
            if(password_verify($request->current_password, $user->password)) {
                if($request->new_password===$request->password_confirmation) {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return back()->with('success_msg', 'Successfully updated user ' . $user->name. ' password!');
                } else {
                    return back()->with('error_msg', 'Password does not match!');
                }
            } else {
                return back()->with('error_msg', 'Current password is not valid');
            }
        } catch(ModelNotFoundException $exception) {
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }
}
