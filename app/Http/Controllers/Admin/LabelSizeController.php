<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LabelSize;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LabelSizeController extends Controller
{
    public $title = "Label sizes";

    public function __construct()
    {
        $this->middleware(['role:super_admin','permission:labelsize_handling']);
    }

    public function index()
    {
        try
        {
            $labelsizes = LabelSize::all();
            $params = [
                'labelsizes' => $labelsizes,
                'title' => $this->title,
            ];
            return view('admin.label.size.index')->with($params);
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
            $labelsizes = LabelSize::all();
            $params = [
                'labelsizes' => $labelsizes,
                'title' => $this->title,
            ];
            return view('admin.label.size.create')->with($params);
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
                'code' => 'required|unique:label_styles,code',
                'name' => 'required|unique:label_styles,name',
            ]);
            $new_labelsize = new LabelSize();
            $name = $request->name;
            $new_labelsize->code = $request->code;
            $new_labelsize->name = $name;
            $new_labelsize->save();
            return back()->with('success_msg', 'Successfully added new label size ' . $name);
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
            $labelsize = LabelSize::findOrFail($id);
            $params = [
                'labelsize' => $labelsize,
                'title' => $this->title,
            ];
            return view('admin.label.size.show')->with($params);
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
            $labelsize = LabelSize::findOrFail($id);

            if ($labelsize->code != $request->code or !$request->code)
            {
                $this->validate($request, [
                    'code' => 'required|unique:label_sizes,code'
                ]);
            }
            if ($labelsize->name != $request->name or !$request->name)
            {
                $this->validate($request, [
                    'name' => 'required|unique:label_sizes,name'
                ]);
            }
            $name = $labelsize->name;
            $labelsize->code = $request->code;
            $labelsize->name = $request->name;
            $labelsize->save();
            return back()->with('success_msg', 'Successfully updated label size ' . $name);
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
            'id'    => $id,
            'title' => $this->title,
        ];
        return view('admin.label.size.delete')->with($params);
    }

    public function destroy($id)
    {
        try
        {
            $labelsize = LabelSize::findOrFail($id);
            $name = $labelsize->name;
            $labelsize->delete();
            return redirect()->route('labelsize.index')
                             ->with('success_msg', 'Successfully deleted label size ' . $name);
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
