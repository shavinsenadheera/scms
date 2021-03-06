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

class OrderController extends Controller{
   protected $order_ids = array();
   public function getOrders($id){
       if(is_numeric($id)) {
           $orders = Order::where('customer_id', '=', $id)->latest()->paginate(5);
           $statuses = Status::all();
           $labeltypes = LabelType::all();
           $labelsizes = LabelSize::all();
           $labelstyles = LabelStyle::all();
           $params = [
               'orders' => $orders,
               'statuses' => $statuses,
               'labeltypes' => $labeltypes,
               'labelsizes' => $labelsizes,
               'labelstyles' => $labelstyles,
           ];
           return response()->json($params, '200');
       }else{
           return response()->json( [],401);
       }
   }

    public function getAllOrders($id){
        if(is_numeric($id)){
            $orders = Order::where('customer_id','=', $id)->latest()->get();
            if(count($orders) > 0) {
                foreach($orders as $data) {
                    array_push($this->order_ids, $data->id);
                }
                $order_status = OrderStatus::whereIn('order_id',$this->order_ids)->get();
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
            }else {
                return response()->json( [],200);
            }
        }else{
            return response()->json( [],401);
        }
    }

    public function getConcerns($id){
        if(is_numeric($id)) {
            $orders = Order::with([
                'status' => function ($query) {
                    $query->select('id', 'description');
                }
            ])->where('orders.customer_id', '=', $id)
                ->where('concerns.status', '!=', 'pending')
                ->select('order_no', 'order_date', 'delivery_date', 'current_status_id', 'concern')
                ->join('concerns', 'orders.id', '=', 'concerns.orderId')
                ->get();
            return response()->json($orders, '200');
        }else{
            return response()->json( [],401);
        }
    }
}
