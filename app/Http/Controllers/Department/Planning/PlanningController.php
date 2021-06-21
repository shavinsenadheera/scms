<?php

namespace App\Http\Controllers\Department\Planning;

use App\Http\Controllers\Controller;
use App\Models\Admin\Employee;
use App\Models\Admin\Order;
use App\Models\Admin\OrderStatus;
use App\Models\Admin\PriorityType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class PlanningController extends Controller
{
    public $title = "Order planning";

    public function index()
    {
        try
        {
            $orders = Order::where('current_status_id', '=', 2)
                            ->latest()
                            ->get();
            $priorities = PriorityType::all();
            $params = [
                'orders' => $orders,
                'title' => $this->title,
                'priorities' => $priorities,
            ];
            return view('departments.planning.index')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function priorityUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'priority_id'   => 'required',
        ]);
        $order = Order::findOrFail(decrypt($id));
        $name = $order->order_no;
        $order->priority_id = $request->priority_id;
        $order->save();
        return back()->with('success_msg', 'Successfully updated order priority ' . $name);
    }

    public function planningBoard()
    {
        $normal_orders = Order::where('priority_id','=',1)
                              ->where('current_status_id','<',4)
                              ->get();
        $speed_orders = Order::where('priority_id','=',2)
                             ->where('current_status_id','<',4)
                             ->get();
        $rapid_orders = Order::where('priority_id','=',3)
                             ->where('current_status_id','<',4)
                             ->get();
        $priorities = PriorityType::all();

        $params = [
            'normal_orders' => $normal_orders,
            'speed_orders'  => $speed_orders,
            'rapid_orders'  => $rapid_orders,
            'priorities'    => $priorities,
            'title'         => $this->title,
        ];
        return view('departments.planning.board')->with($params);
    }

    public function scanView()
    {
        try
        {
            $cs_employees = Employee::where('department_id', '=', 4)
                                    ->get();
            $params = [
                'cs_employees' => $cs_employees,
                'title' => $this->title,
            ];
            return view('departments.planning.scan')->with($params);
        }
        catch (ModelNotFoundException $exception)
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
                if ($order[0]->current_status_id > 0)
                {
                    $order_status = OrderStatus::where('order_id', '=', $order[0]->id)
                                               ->first();
                    if ($order_status->status_2 and $order_status->status_2_empid and $order_status->status_2_datetime)
                    {
                        return response()->json(['success' => 'Order is already scanned by ' . $order_status->status2employee->name . ' at ' . $order_status->status_2_datetime . '!']);
                    }
                    else
                    {
                        $order_status->status_2 = 2;
                        $order_status->status_2_empid = $employee_id;
                        $order_status->status_2_datetime = now();
                        $order_status->save();
                        $order[0]->current_status_id = 2;
                        $order[0]->save();
                        return response()->json(['success' => 'Successfully scanned the order!']);
                    }
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

}
