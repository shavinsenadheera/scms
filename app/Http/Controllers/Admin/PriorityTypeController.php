<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PriorityType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PriorityTypeController extends Controller
{
    public $title = "Priority type";

    public function index()
    {
        try {
            $prioritytypes = PriorityType::all();
            $params = [
                'prioritytypes' => $prioritytypes,
                'title'         => $this->title,
            ];
            return view('admin.priority.index')->with($params);
        }catch(ModelNotFoundException $exception){
            if ($exception instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function create()
    {
        return view('admin.priority.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'code' => 'required|unique:priority_types,code',
                'name' => 'required|unique:priority_types,name'
            ]);
            $name = $request->name;
            $new_prioritytype = new PriorityType();
            $new_prioritytype->code = $request->code;
            $new_prioritytype->name = $request->name;
            $new_prioritytype->save();
            return back()->with('success_msg', 'Successfully added new priority type ' . $name);
        }catch(ModelNotFoundException $exception){
            if ($exception instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function show($id)
    {
        try {
            $prioritytype = PriorityType::findOrFail(decrypt($id));
            $params = [
                'prioritytype' => $prioritytype,
                'title'         => $this->title,
            ];
            return view('admin.priority.show')->with($params);
        }catch (ModelNotFoundException $exception){
            if ($exception instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $prioritytype = PriorityType::findOrFail($id);

            if ($prioritytype->code != $request->code or !$request->code) {
                $this->validate($request, [
                    'code' => 'required|unique:priority_types,code'
                ]);
            }
            if ($prioritytype->name != $request->name or !$request->name) {
                $this->validate($request, [
                    'name' => 'required|unique:priority_types,name'
                ]);
            }
            $name = $prioritytype->name;
            $prioritytype->code = $request->code;
            $prioritytype->name = $request->name;
            $prioritytype->save();
            return back()->with('success_msg', 'Successfully updated priority type ' . $name);
        }catch(ModelNotFoundException $exception){
            if ($exception instanceof ModelNotFoundException){
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
        return view('admin.priority.delete')->with($params);
    }

    public function destroy($id)
    {
        try {
            $prioritytype = PriorityType::findOrFail($id);
            $name = $prioritytype->name;
            $prioritytype->delete();
            return redirect()->route('prioritytype.index')->with('success_msg', 'Successfully deleted priority type ' . $name);
        }catch (ModelNotFoundException $exception){
            if ($exception instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

}
