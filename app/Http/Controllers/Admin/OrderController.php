<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Customer\OrderProcess;
use App\Mail\Internal\PlanningNewOrder;
use App\Models\Admin\LabelSize;
use App\Models\Admin\Order;
use App\Models\Admin\OrderStatus;
use App\Models\Concern;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public $title = "Order handling";

    public function __construct()
    {
        $this->middleware(['role:super_admin|cs_manager|cs_coordinator','permission:order_handling']);
    }

    public function index()
    {
        try {
            $orders = Order::all()
                           ->where('current_status_id','!=',6)
                           ->sortByDesc('created_at');

            $done_orders = Order::all()
                                ->where('current_status_id','=',6)
                                ->sortByDesc('created_at');

            $delayedOrders = Order::whereDate('delivery_date','<',now()->toDate())
                                  ->get();

            $params = [
                'orders'        => $orders,
                'done_orders'   => $done_orders,
                'delayedOrders' => $delayedOrders,
                'title'         => $this->title,
            ];
            return view('admin.order.index')->with($params);
        }catch (ModelNotFoundException $ex){
            if ($ex instanceof ModelNotFoundException){
                return response()->view('errors.'.'404');
            }
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        try
        {
            $order = Order::find(decrypt($id));
            $sizes = LabelSize::all();
            $total = 0;
            foreach (json_decode($order->quantity) as $qty)
            {
                $total += $qty;
            }
            $params = [
                'order' => $order,
                'sizes' => $sizes,
                'total' => $total,
                'title' => $this->title,
            ];
            return view('admin.order.show')->with($params);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
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

    public function cs_confirmation_view($id)
    {
        $params = [
            'id' => $id,
        ];
        return view('admin.order.confirm_order')->with($params);
    }

    public function cs_confirmation($id)
    {
        try
        {
            $order_status = new OrderStatus();
            $order_status->order_id = decrypt($id);
            $order_status->status_1 = 1;
            $order_status->status_1_empid = Auth::user()->employee_id;
            $order_status->status_1_datetime = now();
            $order_status->save();

            $order = Order::find(decrypt($id));
            $order->current_status_id = 1;
            $order->taken_by = Auth::user()->employee_id;
            $order->status_id = $order_status->id;
            $order->save();

            $sizes = LabelSize::all();
            $total = 0;

            foreach (json_decode($order->quantity) as $qty)
            {
                $total += $qty;
            }
            $params = [
                'order'         => $order,
                'sizes'         => $sizes,
                'total'         => $total,
                'title'         => $this->title,
                'success_msg'   => 'You are assigned for a job!'
            ];

            $details = [
                'order_id'      => decrypt($id),
                'order_no'      => $order->order_no,
                'customer_name' => $order->customer->name,
                'status'        => $order->status->description,
            ];
            Mail::to('rabbitdevs@gmail.com')->send(new PlanningNewOrder($details));
            Mail::to($order->customer->email)->send(new OrderProcess($details));

            return view('admin.order.show')->with($params);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function concerns()
    {
        try
        {
            $concerns = Concern::with([
                'concernedFrom' => function ($query) {
                    $query->select('id', 'name');
                },
                'concernedTo' => function ($query) {
                    $query->select('id', 'name');
                },
                'order' => function ($query) {
                    $query->select('id', 'order_no', 'customer_id', 'delivery_date', 'order_date');
                },
                'order.customer' => function ($query) {
                    $query->select('id', 'name', 'email');
                }
            ])
            ->select('id', 'orderId', 'concernedBy', 'replyBy', 'status', 'concern', 'reason')
            ->where('replyBy', '=', Auth::id())
            ->paginate(5);

            $params = [
                'concerns' => $concerns
            ];
            return view('departments.cs.concern')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            return response()->view('errors.'.'404');
        }
    }


}
