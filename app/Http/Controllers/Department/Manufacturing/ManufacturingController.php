<?php

namespace App\Http\Controllers\Department\Manufacturing;

use App\Http\Controllers\Controller;
use App\Models\Admin\Employee;
use App\Models\Admin\Order;
use App\Models\Admin\OrderStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ManufacturingController extends Controller
{
    public function scanView()
    {
        try
        {
            $planning_employees = Employee::where('department_id','=',6)
                                          ->get();
            $params = [
                'planning_employees' => $planning_employees,
            ];
            return view('departments.manufacturing.scan')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
    public function scan(Request $request)
    {
        try {
            $validating = $this->validate($request, [
                'order_no'      => 'required',
                'employee_id'   => 'required',
            ]);
            $order_no = $request->order_no;
            $employee_id = $request->employee_id;
            $order = Order::where('order_no', '=', $order_no)
                ->get();
            if (count($order) == 1)
            {
                if ($order[0]->current_status_id > 1)
                {
                    $order_status = OrderStatus::where('order_id', '=', $order[0]->id)
                        ->first();
                    if ($order_status->status_3 and $order_status->status_3_empid and $order_status->status_3_datetime)
                    {
                        return response()->json(['success' => 'Order is already scanned by ' . $order_status->status3employee->name . ' at ' . $order_status->status_3_datetime . '!']);
                    }
                    else
                    {
                        $order_status->status_3 = 3;
                        $order_status->status_3_empid = $employee_id;
                        $order_status->status_3_datetime = now();
                        $order_status->save();
                        $order[0]->current_status_id = 3;
                        $order[0]->save();
                        return response()->json(['success' => 'Successfully scanned the order!']);
                    }
                }
                elseif($order[0]->current_status_id==2)
                {
                    return response()->json(['orderno_invalid' => 'Order is not scanned at Planning!']);
                }
                else
                {
                    return response()->json(['orderno_invalid' => 'Order is not confirmed at Customer Service!']);
                }
            }
            else
            {
                return response()->json(['orderno_invalid' => 'Order no is not valid!']);
            }

            return response()->json(['error' => $validating->errors()->all()]);
        }
        catch (ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function mrIndex()
    {
        return view('admin.mr.index');
    }

}
