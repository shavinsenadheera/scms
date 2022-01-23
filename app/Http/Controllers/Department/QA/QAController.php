<?php

namespace App\Http\Controllers\Department\QA;

use App\Http\Controllers\Controller;
use App\Mail\Customer\OrderProcess;
use App\Models\Admin\Employee;
use App\Models\Admin\Order;
use App\Models\Admin\OrderStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QAController extends Controller
{
    public $title = "QA";

    public function __construct()
    {
        $this->middleware(['role:super_admin|scanning_point_qa','permission:qa_scanning|scanning_point_qa']);
    }

    public function scanView()
    {
        try
        {
            $planning_employees = Employee::where('department_id','=',7)
                                          ->get();
            $params = [
                'manufacturing_employees' => $planning_employees,
                'title'                   => $this->title
            ];
            return view('departments.qa.scan')->with($params);
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
                if ($order[0]->current_status_id > 2)
                {
                    $order_status = OrderStatus::where('order_id', '=', $order[0]->id)
                        ->first();
                    if ($order_status->status_4 and $order_status->status_4_empid and $order_status->status_4_datetime)
                    {
                        return response()->json(['success' => 'Order is already scanned by ' . $order_status->status4employee->name . ' at ' . $order_status->status_4_datetime . '!']);
                    }
                    else
                    {
                        $order_status->status_4 = 4;
                        $order_status->status_4_empid = $employee_id;
                        $order_status->status_4_datetime = now();
                        $order_status->save();
                        $order[0]->current_status_id = 4;
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
