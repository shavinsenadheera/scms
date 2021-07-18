<?php

namespace App\Http\Controllers\Department\Store\Material\Metric;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Admin\MMetric;

class MetricController extends Controller
{
    public $title = "Metric handling";

    public function __construct()
    {
        $this->middleware(['role:super_admin|store_manager|store_coordinator','permission:metric_handling']);
    }

    public function index()
    {
        try
        {
            $metrics = MMetric::all();
            $params = [
                'metrics'   => $metrics,
                'title'     => $this->title
            ];
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }

        return view('departments.stores.metric.index')->with($params);
    }

    public function create()
    {
        return view('departments.stores.materials.metrics.create');
    }

    public function store(Request $request)
    {
        try
        {
            $this->validate($request, [
                'code'  => 'required',
                'name'  => 'required'
            ]);

            $metric = new MMetric();
            $name = $request->name;
            $metric->code = $request->code;
            $metric->name = $name;
            $metric->save();

            return back()->with('success_msg', 'Successfully added new metric ' . $name);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function show($id)
    {
        try
        {
            $metric = MMetric::findOrFail(decrypt($id));
            $params = [
                'metric'    => $metric,
                'title'     => $this->title
            ];

            return view('departments.stores.metric.show')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'code'  => 'required',
                'name'  => 'required',
            ]);

            $metric = MMetric::findOrfail(decrypt($id));
            $name = $request->name;
            $metric->code = $request->code;
            $metric->name = $name;
            $metric->save();

            return back()->with('success_msg', 'Successfully updated metric ' . $name);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function destroy($id)
    {
        try
        {
            $metric = MMetric::findOrFail(decrypt($id));
            $name = $metric->name;
            $metric->delete();

            return redirect()->route('metric.index')->with('success_msg', 'Successfully deleted metric ' . $name);
        }
        catch(QueryException $exception)
        {
            if($exception instanceof QueryException)
            {
                return response()->view('errors.'.'401');
            }
        }
    }

    public function delete($id)
    {
        $params = [
            'id'    => decrypt($id),
            'title'     => $this->title
        ];
        return view('departments.stores.metric.delete')->with($params);
    }
}
