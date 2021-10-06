<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Mail\Internal\NewOrder;
use App\Models\Admin\LabelSize;
use App\Models\Admin\LabelStyle;
use App\Models\Admin\LabelType;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MakeOrderController extends Controller
{
    public function index()
    {
        $labeltypes = LabelType::all();
        $labelsizes = LabelSize::all();
        $labelstyles = LabelStyle::all();

        $params = [
            'labeltypes' => $labeltypes,
            'labelsizes' => $labelsizes,
            'labelstyles'=> $labelstyles,
        ];
        return response()->json($params, '200');
    }

    public function store(Request $request)
    {
        $new_order = new Order();
        $new_order->order_no = random_int(10000000000, 99999999999);
        $new_order->order_date = now()->toDate();
        $new_order->delivery_date = $request->inputList[0]['delivery_date'];
        $new_order->customer_id = $request->customerid;
        $new_order->label_type = $request->inputList[0]['label_type'];
        $new_order->style_no = $request->inputList[0]['style_no'];
        $new_order->reference_document = $request->inputList[0]['referencedoc'];
        $size_nos = array();
        $qtys = array();
        for ($i = 0; $i < $request->count; $i++)
        {
            array_push($size_nos, $request->inputList[$i]['size_no']);
            array_push($qtys, $request->inputList[$i]['qty']);
        }
        $new_order->size_no = json_encode($size_nos);
        $new_order->quantity = json_encode($qtys);


        if($new_order->save())
        {
            $details = [
                'customer_name' => $new_order->customer->name,
                'order_no'      => $new_order->order_no,
                'order_id'      => $new_order->id,
                'order_date'      => $new_order->order_date,
            ];
            Mail::to('shavinsenadeera@gmail.com')->send(new NewOrder($details));
            return response()->json('Order make successfully!', '204');
        }
        else
        {
            return response()->json('Getting error!', '400');
        }
    }

    public function show($id)
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
