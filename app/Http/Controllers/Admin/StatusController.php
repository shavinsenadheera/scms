<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Status;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public $title = "Status handling";

    public function __construct()
    {
        $this->middleware(['role:super_admin|it_admin','permission:status_handling']);
    }

    public function index()
    {
        try {
            $statuses = Status::all();
            $params = [
                'statuses' => $statuses,
                'title' => $this->title,
            ];
            return view('admin.status.index')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function create()
    {
        return view('admin.status.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'description' => 'required',
            ]);
            $new_status = new Status();
            $new_status->description = $request->description;
            $new_status->save();
            return back()->with('success_msg', 'Successfully added new status!');
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function show($id)
    {
        try {
            $status = Status::findOrFail(decrypt($id));
            $params = [
                'status' => $status,
                'title' => $this->title,
            ];
            return view('admin.status.show')->with($params);
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
                'description' => 'required',
            ]);
            $status = Status::findOrFail($id);
            $status->description = $request->description;
            $status->save();
            return back()->with('success_msg', 'Successfully updated the status!');
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
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
        return view('admin.status.delete')->with($params);
    }

    public function destroy($id)
    {
        try {
            $status = Status::findOrFail($id);
            $description = $status->description;
            $status->delete();
            return redirect()->route('status.index')->with('success_msg', 'Successfully deleted status ' . $description);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }
}
