<?php

namespace App\Console\Commands;

use App\Mail\Internal\RemindDueOrder;
use App\Models\Admin\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RemindDueOrders extends Command
{
    protected $signature = 'command:dueorder';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dueOrders = Order::with([
            'employee' => function($query) {
                $query->select('id');
            },
            'employee.user' => function($query) {
                $query->select('employee_id','email');
            }
        ])->where('current_status_id', '!=', 6)
            ->whereDate('delivery_date','<',now()->toDate())
            ->get();
        foreach($dueOrders as $order){
            $deliveryDate = $order->delivery_date;
            $orderNo = $order->order_no;
            $data = array('orderNo'=>$orderNo, 'deliveryDate'=> $deliveryDate, 'url' => $order->id);
            if(isset($order->taken_by))
            {
                Mail::to($order->employee->user->email)->send(new RemindDueOrder($data));
            }
            else
            {
                Mail::to('csmanager@abctl.com')->send(new RemindDueOrder($data));
            }
        }

    }
}
