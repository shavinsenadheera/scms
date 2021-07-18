<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use App\Models\Admin\Designation;
use App\Models\Admin\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public $title = "Employee";

    public function __construct()
    {
        $this->middleware(['role:super_admin|it_admin','permission:employee_handling']);
    }

    public function index()
    {
        try
        {
            $employees = Employee::all();
            $params = [
                'employees' => $employees,
                'title' => $this->title,
            ];
            return view('admin.employee.index')->with($params);
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
                'epfno' => 'required|unique:employee,epfno',
                'name' => 'required',
                'contact_no' => 'required',
                'department_id' => 'required',
                'designation_id' => 'required',
            ]);
            $employee = new Employee();
            $name = $request->name;
            $employee->epfno = $request->epfno;
            $employee->name = $request->name;
            $employee->contact_no = $request->contact_no;
            $employee->department_id = $request->department_id;
            $employee->designation_id = $request->designation_id;
            $employee->save();
            return back()->with('success_msg', 'Successfully added new employee ' . $name);
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
            $employee = Employee::findOrFail(decrypt($id));
            $department = Department::all();
            $designations = Designation::all();
            $params = [
                'employee' => $employee,
                'departments' => $department,
                'designations' => $designations,
                'title' => $this->title,
            ];
            return view('admin.employee.show')->with($params);
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
            $employee = Employee::findOrFail($id);

            if ($employee->epfno != $request->epfno or !$request->epfno)
            {
                $this->validate($request, [
                    'epfno' => 'required|unique:employee,epfno'
                ]);
            }
            $this->validate($request, [
                'name' => 'required',
                'contact_no' => 'required',
                'department_id' => 'required',
                'designation_id' => 'required',
            ]);
            $name = $employee->name;
            $employee->epfno = $request->epfno;
            $employee->name = $request->name;
            $employee->contact_no = $request->contact_no;
            $employee->department_id = $request->department_id;
            $employee->designation_id = $request->designation_id;
            $employee->save();
            return back()->with('success_msg', 'Successfully updated employee ' . $name);
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
            'id'=>decrypt($id),
            'title'=>$this->title,
        ];
        return view('admin.employee.delete')->with($params);
    }

    public function destroy($id)
    {
        try
        {
            $employee = Employee::findOrFail($id);
            $name = $employee->name;
            $employee->delete();
            return redirect()->route('employee.index')->with('success_msg', 'Successfully deleted employee ' . $name);
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
            $designations = Designation::all();
            $departments = Department::all();
            $params = [
                'employees' => $employees,
                'departments' => $departments,
                'designations' => $designations,
                'title' => $this->title,
            ];
            return view('admin.employee.create')->with($params);
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
