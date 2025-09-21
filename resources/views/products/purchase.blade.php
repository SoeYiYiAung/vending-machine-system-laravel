@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Buy {{ $product->name }}</h4>
        </div>
        <div class="card-body">
            
            {{-- Error Messages --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Purchase Form --}}
            <form method="POST" action="{{ route('products.purchase', $product) }}">
                @csrf

                <div class="mb-3">
                    <label for="quantity" class="form-label">
                        Quantity (Available: <span class="fw-bold">{{ $product->quantity_available }}</span>)
                    </label>
                    <input type="number" 
                           class="form-control @error('quantity') is-invalid @enderror" 
                           id="quantity" 
                           name="quantity" 
                           min="1" 
                           max="{{ $product->quantity_available }}" 
                           required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Products
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-cart-check"></i> Purchase
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
