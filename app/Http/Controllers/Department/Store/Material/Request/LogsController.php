<?php

namespace App\Http\Controllers\Department\Store\Material\Request;

use App\Http\Controllers\Controller;
use App\Models\Admin\Material;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Admin\MRLogs;

class LogsController extends Controller{
    public $title = "Logs";

    public function __construct(){
        $this->middleware(['role:super_admin|store_manager|store_coordinator|production_manager|production_coordinator','permission:logs_handling']);
    }

    public function index(){
        try {
            $mrlogs = MRLogs::where('status','=',0)->get();
            $params = [
                'mrlogs' => $mrlogs,
                'title'  => $this->title,
            ];
            return view('departments.stores.request.index')->with($params);
        } catch(ModelNotFoundException $exception) {
            if($exception instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function fullIndex(){
        try {
            $mrlogs = MRLogs::all();
            $params = [
                'mrlogs' => $mrlogs,
                'title'  => $this->title,
            ];
            return view('departments.stores.request.fullindex')->with($params);
        } catch(ModelNotFoundException $exception) {
            if($exception instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function show($id){
        try {
            $mrlog = MRLogs::findOrFail(decrypt($id));
            $params = [
                'mrlog' => $mrlog,
                'title' => $this->title,
            ];
            return view('departments.stores.request.show')->with($params);
        } catch(ModelNotFoundException $exception) {
            if($exception instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function accept($id){
        try {
            $mrlog = MRLogs::findOrFail(decrypt($id));
            if($mrlog->status==0) {
                $mrlog->status = 1;
                $mrlog->save();
                $material = Material::findOrFail($mrlog->materials_id);
                $material->current_count -= $mrlog->request_count;
                $material->save();
                return back()->with('success_msg', 'Accept the MRN successfully!');
            } else {
                return back()->with('error_msg', 'MRN is already accepted!');
            }
        } catch(ModelNotFoundException $exception) {
            if($exception instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }
}
