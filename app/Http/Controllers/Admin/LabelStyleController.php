<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LabelStyle;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LabelStyleController extends Controller
{
    public $title = "Label styles";

    public function __construct()
    {
        $this->middleware(['role:super_admin','permission:labelstyle_handling']);
    }

    public function index()
    {
        try {
            $labelstyles = LabelStyle::all();
            $params = [
                'labelstyles' => $labelstyles,
                'title' => $this->title,
            ];
            return view('admin.label.style.index')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function create()
    {
        try {
            $labelstyles = LabelStyle::all();
            $params = [
                'labelstyles' => $labelstyles,
                'title' => $this->title,
            ];
            return view('admin.label.style.create')->with($params);
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
                'code' => 'required|unique:label_styles,code',
                'name' => 'required|unique:label_styles,name',
            ]);
            $new_labeltype = new LabelStyle();
            $name = $request->name;
            $new_labeltype->code = $request->code;
            $new_labeltype->name = $name;
            $new_labeltype->save();
            return back()->with('success_msg', 'Successfully added new label style ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function show($id)
    {
        try {
            $labelstyle = LabelStyle::findOrFail($id);
            $params = [
                'labelstyle' => $labelstyle,
                'title' => $this->title,
            ];
            return view('admin.label.type.show')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $labelstyle = LabelStyle::findOrFail($id);

            if ($labelstyle->code != $request->code or !$request->code) {
                $this->validate($request, [
                    'code' => 'required|unique:label_styles,code'
                ]);
            }
            if ($labelstyle->name != $request->name or !$request->name) {
                $this->validate($request, [
                    'name' => 'required|unique:label_styles,name'
                ]);
            }
            $name = $labelstyle->name;
            $labelstyle->code = $request->code;
            $labelstyle->name = $request->name;
            $labelstyle->save();
            return back()->with('success_msg', 'Successfully updated label style ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function delete($id)
    {
        $params = [
            'id'    => $id,
            'title' => $this->title,
        ];
        return view('admin.label.style.delete')->with($params);
    }

    public function destroy($id)
    {
        try {
            $labelstyle = LabelStyle::findOrFail($id);
            $name = $labelstyle->name;
            $labelstyle->delete();
            return redirect()->route('labelstyle.index')->with('success_msg', 'Successfully deleted label style ' . $name);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }
}
