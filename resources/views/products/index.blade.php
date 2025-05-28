@extends('layouts.app')

@section('title', 'Produits')

@section('content')
<div class="container mt-4">
    
    <h1 class="mb-4 text-center">🛍️ Liste des produits</h1>

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm d-flex flex-column">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: contain;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <!-- Fixer le prix + bouton en bas -->
                    <div class="mt-auto">
                        <p class="card-text fw-bold text-center mb-2">{{ $product->price }} MAD</p>
        
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
