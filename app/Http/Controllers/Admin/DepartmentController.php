<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use App\Models\Admin\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public $title = "Departments";

    public function __construct()
    {
        $this->middleware(['role:super_admin','permission:department_handling']);
    }

    public function index()
    {
        try
        {
            $departments = Department::all();
            $params = [
                'departments' => $departments,
                'title' => $this->title,
            ];
            return view('admin.department.index')->with($params);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function store(Request $request)
    {
        try
        {
            $this->validate($request, [
                'code' => 'required|unique:department,code',
                'name' => 'required|unique:department,name',
                'departmenthead_id' => 'required',
            ]);
            $department = new Department();
            $name = $request->name;
            $department->code = $request->code;
            $department->name = $name;
            $department->departmenthead_id = $request->departmenthead_id;
            $department->save();
            return back()->with('success_msg', 'Successfully added new department ' . $name);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function show($id)
    {
        try
        {
            $department = Department::findOrFail(decrypt($id));
            $employees = Employee::all();
            $params = [
                'department'=> $department,
                'employees' => $employees,
                'title'     => $this->title,
            ];
            return view('admin.department.show')->with($params);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }


    public function update(Request $request, $id)
    {
        try
        {
            $department = Department::findOrFail($id);

            if ($department->code != $request->code or !$request->code)
            {
                $this->validate($request, [
                    'code' => 'required|unique:department,code'
                ]);
            }
            if ($department->name != $request->name or !$request->name)
            {
                $this->validate($request, [
                    'name' => 'required|unique:department,name'
                ]);
            }
            $this->validate($request, [
                'departmenthead_id' => 'required',
            ]);
            $name = $department->name;
            $department->code = $request->code;
            $department->name = $request->name;
            $department->departmenthead_id = $request->departmenthead_id;
            $department->save();
            return back()->with('success_msg', 'Successfully updated department ' . $name);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function delete($id)
    {
        $params = [
            'id'    => decrypt($id),
            'title' => $this->title,
        ];
        return view('admin.department.delete')->with($params);
    }

    public function destroy($id)
    {
        try
        {
            $department = Department::findOrFail($id);
            $name = $department->name;
            $department->delete();
            return redirect()->route('department.index')->with('success_msg', 'Successfully deleted department ' . $name);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function create()
    {
        try
        {
            $employees = Employee::all();
            $params = [
                'employees' => $employees,
                'title' => $this->title,
            ];
            return view('admin.department.create')->with($params);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
}
