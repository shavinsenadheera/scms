<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Error;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ErrorController extends Controller
{
    public $title = "Errors handling";

    public function __construct()
    {
        $this->middleware(['role:super_admin','permission:error_handling']);
    }

    public function index()
    {
        try {
            $errors = Error::all();
            $params = [
                'errors' => $errors,
                'title'  => $this->title,
            ];
            return view('admin.error.index')->with($params);
        } catch (ModelNotFoundException $exception) {
            if ($exception instanceof ModelNotFoundException)
                return response()->view('errors.' . '404');
        }

    }

    public function deleteAll()
    {
        try
        {
            Error::truncate();
            return back()->with('success_msg', 'Successfully clear all error logs!');
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
}
