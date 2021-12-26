<?php

namespace App\Http\Controllers\Department\Store\Material;

use App\Http\Controllers\Controller;
use App\Models\Admin\MTransaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        try {
            $mtransactions = MTransaction::orderByDesc('created_at')->get();
            $params = [
                'mtransactions' => $mtransactions
            ];
            return view('departments.stores.material.transactions')->with($params);
        } catch(ModelNotFoundException $exception) {
            if($exception instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }
}
