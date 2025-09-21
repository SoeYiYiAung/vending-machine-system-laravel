@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Edit Product</h4>
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

            {{-- Form --}}
            <form method="POST" action="{{ route('products.update', $product) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $product->name) }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (USD)</label>
                    <input type="number" 
                           class="form-control @error('price') is-invalid @enderror" 
                           id="price" 
                           name="price" 
                           value="{{ old('price', $product->price) }}" 
                           step="0.01" 
                           min="0.01" 
                           required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity_available" class="form-label">Quantity Available</label>
                    <input type="number" 
                           class="form-control @error('quantity_available') is-invalid @enderror" 
                           id="quantity_available" 
                           name="quantity_available" 
                           value="{{ old('quantity_available', $product->quantity_available) }}" 
                           min="0" 
                           required>
                    @error('quantity_available')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Products
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
