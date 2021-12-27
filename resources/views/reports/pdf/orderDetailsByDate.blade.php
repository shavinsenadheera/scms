@extends('layouts.report')
@section('content')
    <h4 id="name">{{__('Report Name: Order Details')}}</h4>
    <h6>{{__('Date Range: ')}} {{$fromDate.' to '.$toDate}} </h6>
    <table>
        <thead>
        <tr class="bold">
            <th scope="col">Order #</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Order Date</th>
            <th scope="col">Delivery Date</th>
            <th scope="col">Responsible By</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ordersDateTotalReport as $order)
            <tr>
                <td>{{ $order->order_no }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->delivery_date }}</td>
                <td>{{ $order->taken_by ? $order->employee->name : 'Not Taken Yet' }}</td>
                <td>{{ $order->current_status_id ? $order->status->description : 'Not Taken Yet' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
