<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LabelType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LabelTypeController extends Controller{
    public $title = "Label Types";

    public function __construct(){
        $this->middleware(['role:super_admin','permission:labeltype_handling']);
    }

    public function index(){
        try {
            $labeltypes = LabelType::all();
            $params = [
                'labeltypes' => $labeltypes,
                'title' => $this->title,
            ];
            return view('admin.label.type.index')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function create(){
        try {
            $labeltypes = LabelType::all();
            $params = [
                'labeltypes' => $labeltypes,
                'title' => $this->title,
            ];
            return view('admin.label.type.create')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function store(Request $request){
        try {
            $this->validate($request, [
                'code' => 'required|unique:label_types,code',
                'name' => 'required|unique:label_types,name',
            ]);
            $new_labeltype = new LabelType();
            $name = $request->name;
            $new_labeltype->code = $request->code;
            $new_labeltype->name = $name;
            $new_labeltype->save();
            return back()->with('success_msg', 'Successfully added new label type ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function show($id){
        try {
            $labeltype = LabelType::findOrFail(decrypt($id));
            $params = [
                'labeltype' => $labeltype,
                'title' => $this->title,
            ];
            return view('admin.label.type.show')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function update(Request $request, $id){
        try {
            $labeltype = LabelType::findOrFail(decrypt($id));

            if ($labeltype->code != $request->code or !$request->code) {
                $this->validate($request, [
                    'code' => 'required|unique:label_types,code'
                ]);
            }
            if ($labeltype->name != $request->name or !$request->name) {
                $this->validate($request, [
                    'name' => 'required|unique:label_types,name'
                ]);
            }
            $name = $labeltype->name;
            $labeltype->code = $request->code;
            $labeltype->name = $request->name;
            $labeltype->save();
            return back()->with('success_msg', 'Successfully updated label type ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }
    public function delete($id){
        $params = [
            'id'    => $id,
            'title' => $this->title,
        ];
        return view('admin.label.type.delete')->with($params);
    }

    public function destroy($id){
        try {
            $labeltype = LabelType::findOrFail(decrypt($id));
            $name = $labeltype->name;
            $labeltype->delete();
            return redirect()->route('labeltype.index')->with('success_msg', 'Successfully deleted label type ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }
}
