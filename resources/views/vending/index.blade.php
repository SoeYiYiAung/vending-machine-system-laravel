<!DOCTYPE html>
<html>
<head>
    <title>Vending Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h1>Vending Machine</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>{{ $product->name }}</h5>
                        <p>Price: ${{ $product->price }}</p>
                        <p>Stock: {{ $product->stock }}</p>
                        <form method="POST" action="{{ route('buy', $product->id) }}">
                            @csrf
                            <input type="number" step="0.01" name="amount" placeholder="Insert money" class="form-control mb-2" required>
                            <button type="submit" class="btn btn-primary">Buy</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
