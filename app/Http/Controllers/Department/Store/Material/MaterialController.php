<?php

namespace App\Http\Controllers\Department\Store\Material;

use App\Http\Controllers\Controller;
use App\Models\Admin\Error;
use App\Models\Admin\MTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Admin\Material;
use App\Models\Admin\MMetric;
use App\Models\Admin\Supplier;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public $title = "Material handling";

    public function __construct()
    {
        $this->middleware(['role:super_admin|store_manager|store_coordinator','permission:material_handling']);
    }

    public function index()
    {
        try
        {
            $materials = Material::all()->sortBy('name');
            $metrics = MMetric::all();
            $suppliers = Supplier::all();

            $params = [
                'materials'     => $materials,
                'metrics'       => $metrics,
                'suppliers'     => $suppliers,
                'title'         => $this->title
            ];
            return view('departments.stores.material.index')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function store(Request $request){
        try {
            $this->validate($request,[
                'name'          => 'required',
                'm_metrics_id'  => 'required',
                'suppliers_id'  => 'required',
                'threshold'  => 'required|numeric',
            ]);
            $material = new Material();
            $name = $request->name;
            $material->name = $name;
            $material->m_metrics_id = $request->m_metrics_id;
            $material->suppliers_id = $request->suppliers_id;
            $material->threshold = $request->threshold;
            $material->save();
            return back()->with('success_msg', 'Successfully added new metric ' . $name);
        } catch(ModelNotFoundException $exception) {
            if($exception instanceof ModelNotFoundException) {
                $error = new Error();
                $error->description = $exception->getMessage();
                $error->users_id = Auth::id();
                $error->save();
                return response()->view('errors.'.'404');
            }
        }
    }

    public function show($id){
        try {
            $material = Material::findOrFail(decrypt($id));
            $suppliers = Supplier::all();
            $metrics = MMetric::all();

            $params = [
                'material'  => $material,
                'suppliers' => $suppliers,
                'metrics'   => $metrics,
                'title'     => $this->title
            ];

            return view('departments.stores.material.show')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                $error = new Error();
                $error->description = $exception->getMessage();
                $error->users_id = Auth::id();
                $error->save();
                return response()->view('errors.'.'404');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $this->validate($request,[
                'name'          => 'required',
                'metrics_id'  => 'required',
                'suppliers_id'  => 'required',
                'threshold'  => 'required|numeric',
            ]);

            $material = Material::findOrFail(decrypt($id));
            $name = $request->name;
            $material->name = $name;
            $material->m_metrics_id = $request->metrics_id;
            $material->suppliers_id = $request->suppliers_id;
            $material->threshold = $request->threshold;
            $material->save();

            return back()->with('success_msg', 'Successfully updated material ' . $name);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                $error = new Error();
                $error->description = $exception->getMessage();
                $error->users_id = Auth::id();
                $error->save();
                return response()->view('errors.'.'404');
            }
        }
    }

    public function destroy($id){
        try {
            $material = Material::findOrFail(decrypt($id));
            $name = $material->name;
            $material->delete();
            return redirect()->route('material.index')->with('success_msg', 'Successfully deleted material ' . $name);
        } catch(QueryException $exception) {
            if($exception instanceof QueryException) {
                $error = new Error();
                $error->description = $exception->getMessage();
                $error->users_id = Auth::id();
                $error->save();
                return response()->view('errors.'.'401');
            }
        }
    }

    public function delete($id){
        $params = [
            'id'    => decrypt($id),
            'title'     => $this->title
        ];
        return view('departments.stores.material.delete')->with($params);
    }
}
