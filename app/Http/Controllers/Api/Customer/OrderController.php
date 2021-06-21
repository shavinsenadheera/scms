<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Admin\Employee;
use App\Models\Admin\LabelSize;
use App\Models\Admin\LabelStyle;
use App\Models\Admin\LabelType;
use App\Models\Admin\Order;
use App\Models\Admin\OrderStatus;
use App\Models\Admin\Status;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order_ids = array();

   public function getOrders($id)
   {
       $orders = Order::where('customer_id','=', $id)->latest()->paginate(3);
       $statuses = Status::all();
       $labeltypes = LabelType::all();
       $labelsizes = LabelSize::all();
       $labelstyles = LabelStyle::all();
       $params = [
           'orders'     => $orders,
           'statuses'   => $statuses,
           'labeltypes' => $labeltypes,
           'labelsizes' => $labelsizes,
           'labelstyles'=> $labelstyles,
       ];
       return response()->json($params, '200');
   }

    public function getAllOrders($id)
    {
        $orders = Order::where('customer_id','=', $id)
                       ->latest()
                       ->get();
        foreach($orders as $data)
        {
            array_push($this->order_ids, $data->id);
        }
        $order_status = OrderStatus::whereIn('order_id',$this->order_ids)
                                   ->get();
        $statuses   = Status::all();
        $labeltypes = LabelType::all();
        $labelsizes = LabelSize::all();
        $labelstyles= LabelStyle::all();
        $employees  = Employee::all();
        $users      = User::all();

        $params = [
            'orders'        => $orders,
            'statuses'      => $statuses,
            'labeltypes'    => $labeltypes,
            'labelsizes'    => $labelsizes,
            'labelstyles'   => $labelstyles,
            'order_status'  => $order_status,
            'employees'     => $employees,
            'users'         => $users,
        ];
        return response()->json($params, '200');
    }
}
