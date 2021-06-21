<?php

namespace App\Http\Controllers\Department\Store\Material\Request;

use App\Http\Controllers\Controller;
use App\Mail\Internal\MRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Admin\MRLogs;
use App\Models\Admin\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    public $title = "Requests";

    public function index()
    {
        $materials = Material::all();

        $params = [
            'materials' => $materials,
            'title'     => $this->title,
        ];

        return view('departments.manufacturing.m_request')->with($params);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try
        {
            $this->validate($request, [
                'materials_id'  => 'required',
                'request_count' => 'required|integer|min:1',
            ]);

            $material =Material::findOrfail($request->materials_id);
            if($material->current_count >= $request->request_count)
            {
                $mrlog = new MRLogs();
                $mrlog->users_id = Auth::id();
                $mrlog->materials_id = $request->materials_id;
                $mrlog->request_count = $request->request_count;
                $mrlog->save();

                $details = [
                    'employee_name'     => Auth::user()->name,
                    'request_material'  => $mrlog->materials->name,
                    'request_count'     => $request->request_count,
                    'request_id'        => $mrlog->id
                ];

                Mail::to('shavinsenadeera@gmail.com')->send(new MRequest($details));
                return back()->with('success_msg', 'Successfully request for the material.');
            }
            else
            {
                return back()->with('error_msg', 'Request materials are not enough!');
            }
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
                'materials_id'  => 'required',
                'request_count' => 'required|integer|min:1',
            ]);

            $material = Material::findOrfail($request->materials_id);
            if($material->current_count >= $request->request_count)
            {
                $mrlog = MRLogs::findOrFail(decrypt($id));
                $mrlog->users_id = Auth::id();
                $mrlog->materials_id = $request->materials_id;
                $mrlog->request_count = $request->request_count;
                $mrlog->save();

                return back()->with('success_msg', 'Successfully updated request ');
            }
            else
            {
                return back()->with('error_msg', 'Request materials are not enough!');
            }
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
        //
    }
}
