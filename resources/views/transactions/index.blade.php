@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Transactions</h4>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            @if(auth()->user()->role == 'admin')
                                <th>User</th>
                            @endif
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price (USD)</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            @if(auth()->user()->role == 'admin')
                                <td>{{ $transaction->user->name }}</td>
                            @endif
                            <td>{{ $transaction->product->name }}</td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>${{ number_format($transaction->total_price, 2) }}</td>
                            <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $transactions->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
