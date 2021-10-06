<?php

namespace App\Http\Controllers;

use App\Mail\Customer\OrderConcern;
use App\Models\Admin\Order;
use App\Models\Concern;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ConcernController extends Controller
{
    public function index(Request $request)
    {
        try {
            $orders = Order::select(['id', 'order_no'])->get();
            if ($request->input('orderNo')) {
                $orderDetails = Order::with([
                    'employee' => function($query) {
                        $query->select('id', 'name');
                    },
                    'status' => function ($query) {
                        $query->select('id', 'description');
                    }
                ])->select([
                    'id',
                    'order_no',
                    'order_date',
                    'delivery_date',
                    'customer_id',
                    'label_type',
                    'style_no',
                    'reference_document',
                    'size_no',
                    'quantity',
                    'taken_by',
                    'current_status_id'
                ])->where('order_no', '=', $_GET['orderNo'])->first();

                $concern = Concern::where('orderId', '=', $orderDetails->id)->first();

                if ($concern) {
                    $params = [
                        'concern' => $concern,
                        'orders' => $orders,
                        'searchVal' => $_GET['orderNo'],
                        'orderDetails' => $orderDetails
                    ];
                } else {
                    $params = [
                        'concern' => null,
                        'orders' => $orders,
                        'searchVal' => $_GET['orderNo'],
                        'orderDetails' => $orderDetails
                    ];
                }

            } else {
                $params = [
                    'orders' => $orders
                ];
            }
            return view('common.concerns.index')->with($params);
        } catch (ModelNotFoundException $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->view('errors.404');
            }
        }
    }

    public function productionInsert(Request $request)
    {
        try
        {
            $this->validate($request, [
                'concern' => [ 'string', 'required' ]
            ]);
            $orderId = $request->orderId;
            $order = Order::select(['id', 'taken_by'])->findOrFail($orderId);
            $concern = $request->concern;
            $newConcern = new Concern();
            $newConcern->orderId = $orderId;
            $newConcern->concern = $concern;
            $newConcern->concernedBy = Auth::id();
            $newConcern->replyBy = $order->taken_by;
            $newConcern->save();
            return back()->with('success', 'New concerned has recorded for '.$orderId);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.404');
            }
        }
    }

    public function csInsert(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'comment' => [ 'string', 'required' ]
            ]);
            $comment = $request->comment;

            $concern = Concern::findOrfail(decrypt($id));
            $concern->reason = $comment;
            $concern->status = 'Reviewed';
            $concern->save();
            return back()->with('success', 'Commented for concern!');
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.404');
            }
        }
    }

    public function informConcern(Request $request)
    {
        try
        {
            $concern = Concern::findOrFail(decrypt($request->concernId));
            $concern->informed_to_customer = true;

            $data = [
                'orderNo' => decrypt($request->orderNo),
                'orderDate' => decrypt($request->orderDate),
                'deliveryDate' => decrypt($request->orderDate),
                'message' => $request->message
            ];

            Mail::to('customer@test.com')
                ->cc(['manager@test.com', 'coordinator@test.com'])
                ->send(new OrderConcern($data));
            $concern->save();

            return back()->with('success_msg', 'Informed to customer!');
        }
        catch(ModelNotFoundException $exception)
        {
            abort(404, 'Model Not Found!');
        }
    }
}
