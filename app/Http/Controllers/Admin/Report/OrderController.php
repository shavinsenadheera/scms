<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Error;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class OrderController extends Controller{
    public function __construct(){
        $this->middleware(['role:super_admin|cs_manager|cs_coordinator','permission:customer_handling|cs_get_report']);
    }

    public function export(){
        try {
            return Excel::download(new OrderExport, 'order_details.xlsx');
        } catch (Exception $exception) {
            $error = new Error();
            $error->description = $exception->getMessage();
            $error->users_id = Auth::id();
            $error->save();
            $error = $exception->getMessage();
            return response()->view('errors.'.'400', compact('error'));
        }
    }
}
