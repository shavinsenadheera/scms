<?php

namespace App\Http\Controllers\Department\Store\Material\Order;

use App\Http\Controllers\Controller;
use App\Models\Admin\Material;
use App\Models\Admin\MTransaction;
use App\Models\Admin\Supplier;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_admin|store_manager|store_coordinator','permission:material_order_handling']);
    }

    public function index()
    {
        $materials =  Material::all();
        $suppliers = Supplier::all();

        $params = [
            'materials' => $materials,
            'suppliers' => $suppliers,
        ];

        return view('departments.stores.order.dashboard')->with($params);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        try
        {
            $length = $request->materials_id;
            for($i = 0; $i < count($length); $i++)
            {
                $orderTransaction = new MTransaction();
                $orderTransaction->users_id = Auth::id();
                $orderTransaction->materials_id = $request->materials_id[$i];
                $orderTransaction->total_count = $request->quantity[$i];
                $orderTransaction->item_price = $request->item_price[$i];
                $orderTransaction->total_price = $request->total[$i];
                $orderTransaction->save();

                $material = Material::findOrFail($request->materials_id[$i]);
                $material->current_count += $request->quantity[$i];
                $material->save();
            }
            return back()->with('success_msg', 'Successfully create the material order!');
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
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
