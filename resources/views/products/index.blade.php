@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold text-gradient" style="font-size: larger">Products</h2>

    @if(auth()->user()->role=='admin')
        <div class="d-flex justify-content-end mt-3 mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-success">
                <i class="bi bi-plus-circle"></i> Create New Product
            </a>
        </div>
    @endif


    {{-- Success Message --}}
    @if(session('success')) 
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive shadow-lg rounded-3 overflow-hidden">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th style="width: 25%">Name</th>
                    <th style="width: 20%">Price (USD)</th>
                    <th style="width: 15%">Stock</th>
                    <th style="width: 40%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="fw-semibold">{{ $product->name }}</td>
                    <td class="text-success fw-bold">${{ number_format($product->price, 2) }}</td>
                    <td class="text-center">
                        @if($product->quantity_available > 0)
                            <span class="badge bg-success px-3 py-2">{{ $product->quantity_available }}</span>
                        @else
                            <span class="badge bg-danger px-3 py-2">Out of Stock</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('products.purchaseForm',$product) }}" 
                           class="btn btn-sm btn-primary me-2 shadow-sm">
                            <i class="bi bi-cart-check"></i> Buy
                        </a>
                        @if(auth()->user()->role=='admin')
                            <a href="{{ route('products.edit',$product) }}" 
                               class="btn btn-sm btn-warning me-2 shadow-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('products.destroy',$product) }}" 
                                  class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- styling --}}
@push('styles')
    <style>
        .text-gradient {
            background: linear-gradient(90deg, #0d6efd, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        table thead th {
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table tbody tr:hover {
            background-color: #f3f6ff !important;
            transition: 0.3s;
        }
    </style>
@endpush
@endsection
