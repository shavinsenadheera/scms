@extends('layouts.report')
@section('content')
<h4 id="name">{{__('Report Name: Material Transactions')}}</h4>
<table>
    <thead>
    <tr class="bold">
        <th scope="col">{{__('Responsible By')}}</th>
        <th scope="col">{{__('Mat. Name')}}</th>
        <th scope="col">{{__('Sup. Name')}}</th>
        <th scope="col">{{__('Tot. Count(m)')}}</th>
        <th scope="col">{{__('Price/Item(LKR/m)')}}</th>
        <th scope="col">{{__('Tot. Price(LKR)')}}</th>
        <th scope="col">{{__('Trans. Date')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
    <tr>
        <td>{{ $transaction->users->employee->name }}</td>
        <td>{{ $transaction->materials->name }}</td>
        <td>{{ $transaction->materials->suppliers->name }}</td>
        <td>{{ number_format($transaction->total_count, 2) }}</td>
        <td>{{ number_format($transaction->item_price, 2) }}</td>
        <td>{{ $transaction->total_price }}</td>
        <td>{{ $transaction->created_at }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
