<?php

namespace App\Http\Controllers\Department\Dispatch;

use App\Http\Controllers\Controller;
use App\Mail\Customer\OrderProcess;
use App\Models\Admin\Employee;
use App\Models\Admin\Order;
use App\Models\Admin\OrderStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DispatchController extends Controller
{
    public $title = "Dispatch";

    public function __construct()
    {
        $this->middleware(['role:super_admin|dispatch_manager|dispatch_coordinator|scanning_point_dispatch','permission:dispatch_handling|dispatch_scanning|dispatch_done_scanning|scanning_point_dispatch']);
    }


    public function scanView()
    {
        try
        {
            $qa_employees = Employee::where('department_id','=',8)
                                    ->get();
            $params = [
                'qa_employees' => $qa_employees,
                'title'        => $this->title
            ];
            return view('departments.dispatch.scan')->with($params);
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
                if ($order[0]->current_status_id > 3)
                {
                    $order_status = OrderStatus::where('order_id', '=', $order[0]->id)
                        ->first();
                    if ($order_status->status_5 and $order_status->status_5_empid and $order_status->status_5_datetime)
                    {
                        return response()->json(['success' => 'Order is already scanned by ' . $order_status->status5employee->name . ' at ' . $order_status->status_5_datetime . '!']);
                    }
                    else
                    {
                        $order_status->status_5 = 5;
                        $order_status->status_5_empid = $employee_id;
                        $order_status->status_5_datetime = now();
                        $order_status->save();
                        $order[0]->current_status_id = 5;
                        $order[0]->save();
                        $details = [
                            'order_no'      => $order[0]->order_no,
                            'status'        => $order[0]->status->description,
                        ];
                        Mail::to($order[0]->customer->email)->send(new OrderProcess($details));
                        return response()->json(['success' => 'Successfully scanned the order!']);
                    }
                }
                elseif($order[0]->current_status_id==2)
                {
                    return response()->json(['orderno_invalid' => 'Order is not scanned by Planning Department!']);
                }
                elseif($order[0]->current_status_id==3)
                {
                    return response()->json(['orderno_invalid' => 'Order is not scanned by Manufacturing Department!']);
                }
                elseif($order[0]->current_status_id==4)
                {
                    return response()->json(['orderno_invalid' => 'Order is not scanned by QA Department!']);
                }
                else
                {
                    return response()->json(['orderno_invalid' => 'Order is not confirmed by Customer Service!']);
                }
            }
            else
            {
                return response()->json(['orderno_invalid' => 'Order no is not valid!']);
            }
        }
        catch (ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function scanDoneView()
    {
        try
        {
            $dispatch_employees = Employee::where('department_id','=',9)
                                          ->get();
            $params = [
                'dispatch_employees' => $dispatch_employees,
            ];
            return view('departments.dispatch.scandone')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
    public function scanDone(Request $request)
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
                if ($order[0]->current_status_id > 4)
                {
                    $order_status = OrderStatus::where('order_id', '=', $order[0]->id)
                                               ->first();
                    if ($order_status->status_6 and $order_status->status_6_empid and $order_status->status_6_datetime)
                    {
                        return response()->json(['success' => 'Order is already scanned by ' . $order_status->status6employee->name . ' at ' . $order_status->status_6_datetime . '!']);
                    }
                    else
                    {
                        $order_status->status_6 = 6;
                        $order_status->status_6_empid = $employee_id;
                        $order_status->status_6_datetime = now();
                        $order_status->save();
                        $order[0]->current_status_id = 6;
                        $order[0]->save();
                        $details = [
                            'order_no'      => $order[0]->order_no,
                            'status'        => $order[0]->status->description,
                        ];
                        Mail::to($order[0]->customer->email)->send(new OrderProcess($details));
                        return response()->json(['success' => 'Successfully scanned the order!']);
                    }
                }
                elseif($order[0]->current_status_id==2)
                {
                    return response()->json(['orderno_invalid' => 'Order is not scanned by Planning Department!']);
                }
                elseif($order[0]->current_status_id==3)
                {
                    return response()->json(['orderno_invalid' => 'Order is not scanned by Manufacturing Department!']);
                }
                elseif($order[0]->current_status_id==4)
                {
                    return response()->json(['orderno_invalid' => 'Order is not scanned by QA Department!']);
                }
                elseif($order[0]->current_status_id==5)
                {
                    return response()->json(['orderno_invalid' => 'Order is not scanned by Dispatch Department!']);
                }
                else
                {
                    return response()->json(['orderno_invalid' => 'Order is not confirmed by Customer Service!']);
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
