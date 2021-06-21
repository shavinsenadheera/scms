<table>
    <thead>
        <tr>
            <td colspan="6" rowspan="2" style="text-align: left;font-weight: bold;font-size: 12px">
                <p >Order Report: {{ now() }}</p>
                <p>Customer Service: +94 81 2300 595</p>
            </td>
            <td colspan="1" rowspan="2" style="text-align: left;align-content: end;align-items: center">
                <img src=".{!! DNS1D::getBarcodePNGPath($order->order_no, 'C39',1,20) !!}" />
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="7" style="background-color: whitesmoke"></td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: center;font-weight: bold;font-size: 14px">
                ABCTL (Pvt) Ltd
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: left;font-size: 14px">
                Order Details
            </td>
        </tr>
        <tr>
            <td colspan="7" style="background-color: whitesmoke"></td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;font-size: 12px;text-align: left">Order no</th>
            <td colspan="2" style="font-size: 12px;text-align: left">{{ $order->order_no }}</td>
            <th colspan="2" style="font-weight: bold;font-size: 12px;text-align: left">Status</th>
            <td colspan="1" style="font-size: 12px;text-align: left">Not Confirmed</td>
        </tr>
        <tr>
            <td colspan="7" style="background-color: whitesmoke"></td>
        </tr>
        <tr>
            <td colspan="7" style="font-weight: bold;font-size: 14px">Customer details</td>
        </tr>
        <tr>
            <td colspan="7" style="background-color: whitesmoke"></td>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Name</th>
            <th colspan="4" style="font-size: 12px;text-align:left">{{ $order->customer->name }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Email</th>
            <th colspan="4" style="font-size: 12px;text-align:left">{{ $order->customer->email }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Tel no</th>
            <th colspan="4" style="font-size: 12px;text-align: left">{{ $order->customer->telephone_no }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Address</th>
            <th colspan="4" style="font-size: 12px;vertical-align: top;text-align: left;">
                <p>{{ $order->customer->address_line_1 }}@isset($order->customer->address_line_2),{{ $order->customer->address_line_1}} @endisset,{{ $order->customer->city }},{{ $order->customer->zipcode }}</p>
            </th>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Tel land no</th>
            <th colspan="4" style="font-size: 12px;text-align: left">{{ $order->customer->telephone_land }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Tel fax no</th>
            <th colspan="4" style="font-size: 12px;text-align: left">{{ $order->customer->telephone_fax }}</th>
        </tr>
        <tr>
            <td colspan="7" style="background-color: whitesmoke"></td>
        </tr>
        <tr>
            <td colspan="7" style="font-weight: bold;font-size: 14px">Order details</td>
        </tr>
        <tr>
            <td colspan="7" style="background-color: whitesmoke"></td>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Customer name</th>
            <th colspan="4" style="font-size: 12px">{{ $order->customer->name }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Delivery date</th>
            <th colspan="4" style="font-size: 12px">{{ $order->delivery_date }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Label type</th>
            <th colspan="4" style="font-size: 12px">{{ $order->labeltype->name }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-size: 12px;font-weight: bold">Style no</th>
            <th colspan="4" style="font-size: 12px">{{ $order->labelstyle->name }}</th>
        </tr>
        <tr>
            <td colspan="7" style="background-color: whitesmoke"></td>
        </tr>
        <tr>
            <td colspan="7" style="font-weight: bold;font-size: 14px">Order overview</td>
        </tr>
        <tr>
            <td colspan="7" style="background-color: whitesmoke"></td>
        </tr>
        <tr style="border: 2px solid black">
            <th colspan="3" style="font-weight: bold;font-size: 14px;border: 1px solid black;">Size</th>
            <th colspan="4" style="font-weight: bold;font-size: 14px;border: 1px solid black;">Qty</th>
        </tr>
        @for($i = 0 ; $i < count(json_decode($order->size_no)); $i++ )
            <tr style="border: 2px solid black">
                @foreach($sizes as $data)
                    @if(json_decode($order->size_no)[$i]==$data->id)
                        <td colspan="3" style="font-weight: bold;font-size: 12px;border: 1px solid black;">{{ $data->name }}</td>
                    @endif
                @endforeach
                <td colspan="4" style="font-weight: bold;font-size: 12px;border: 1px solid black;">{{ json_decode($order->quantity)[$i] }}</td>
            </tr>
        @endfor
        <tr style="border: 2px solid black;background: #e9e9e9">
            <th colspan="3" style="font-weight: bold;font-size: 14px;border: 1px solid black;color:forestgreen">Total</th>
            <th colspan="4" style="font-weight: bold;font-size: 14px;border: 1px solid black;color: forestgreen">{{ $total }}</th>
        </tr>
        <tr>
            <td colspan="7" style="background-color: whitesmoke"></td>
        </tr>
        <tr colspan="7" style="background-color: white"></tr>
        <tr colspan="7" style="background-color: white"></tr>
        <tr colspan="7" style="background-color: white"></tr>
        <tr>
            <th colspan="3">---------------------------------------</th>
            <th colspan="4" style="text-align: right">---------------------------------------</th>
        </tr>
        <tr>
            <th colspan="3">CS Coordinator</th>
            <th colspan="4" style="text-align: right">Dispatch Coordinator</th>
        </tr>
    </thead>
</table>
