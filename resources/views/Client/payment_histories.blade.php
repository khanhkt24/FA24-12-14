@extends('Client.layouts.masterlayout')

@section('content')
    <h1>Lịch sử Thanh Toán</h1>
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paymentHistories as $payment)
                <tr>
                    <td>{{ $payment->order_id }}</td>
                    <td>{{ $payment->transaction_id }}</td>
                    <td>{{ number_format($payment->amount) }} VNĐ</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->payment_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
