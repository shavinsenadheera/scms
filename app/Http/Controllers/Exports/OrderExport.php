<?php

namespace App\Http\Controllers\Exports;

use App\Models\Admin\LabelSize;
use App\Models\Admin\Order;
use App\orders;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrderExport implements FromView
{

    public function view(): View
    {
        $id = request('id');
        $order = Order::findOrFail(decrypt($id));
        $total = 0;
        foreach (json_decode($order->quantity) as $qty)
        {
            $total += $qty;
        }
        $sizes = LabelSize::all();
        return view('admin.exports.orderdetails', [
            'order' => $order,
            'sizes' => $sizes,
            'total' => $total,
        ]);
    }
}
