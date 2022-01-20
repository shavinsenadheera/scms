<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Designation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public $title = "Designation";

    public function __construct(){
        $this->middleware(['role:super_admin|it_admin','permission:designation_handling']);
    }

    public function index(){
        try
        {
            $designations = Designation::all();
            $params = [
                'designations' => $designations,
                'title' => $this->title,
            ];
            return view('admin.designation.index')->with($params);
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
                'code' => 'required|unique:designation,code',
                'name' => 'required|unique:designation,name',
            ]);
            $name = $request->name;
            $designation = new Designation();
            $designation->code = $request->code;
            $designation->name = $name;
            $designation->save();
            return back()->with('success_msg', 'Successfully added new permission ' . $name);
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
            $designation = Designation::findOrFail(decrypt($id));
            $params = [
                'designation' => $designation,
                'title' => $this->title,
            ];
            return view('admin.designation.show')->with($params);
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
            $designation = Designation::findOrFail($id);

            if ($designation->code != $request->code or !$request->code)
            {
                $this->validate($request, [
                    'code' => 'required|unique:designation,code'
                ]);
            }
            if ($designation->name != $request->name or !$request->name)
            {
                $this->validate($request, [
                    'name' => 'required|unique:designation,name'
                ]);
            }
            $name = $designation->name;
            $designation->code = $request->code;
            $designation->name = $request->name;
            $designation->save();
            return back()->with('success_msg', 'Successfully updated designation ' . $name);
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
        return view('admin.designation.delete')->with($params);
    }

    public function destroy($id)
    {
        try
        {
            $designation = Designation::findOrFail($id);
            $name = $designation->name;
            $designation->delete();
            return redirect()->route('designation.index')->with('success_msg', 'Successfully deleted designation ' . $name);
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
        $params = [
            'title'=>$this->title,
        ];
        return view('admin.designation.create')->with($params);
    }
}
