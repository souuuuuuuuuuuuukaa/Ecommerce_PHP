@extends('layouts.app')

@section('title', 'Panier')

@section('content')
<div class="container mt-4">


    <h1 class="mb-4 text-center">🛒 Votre panier</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info">Votre panier est vide.</div>
    @else
        @php $total = 0; @endphp

        @foreach($cart as $id => $product)
            @php
                $subtotal = $product['price'] * $product['quantity'];
                $total += $subtotal;
            @endphp

            <div class="card mb-3 shadow-sm">
                <div class="row g-0 align-items-center">
                    <div class="col-md-2">
                        @if ($product['image'])
                            <img src="{{ asset('storage/' . $product['image']) }}" class="img-fluid rounded-start p-2" alt="{{ $product['name'] }}" style="max-height: 120px; object-fit: contain;">
                        @endif
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text">Quantité : {{ $product['quantity'] }}</p>
                            <p class="card-text"><strong>Sous-total : {{ $subtotal }} MAD</strong></p>
                        </div>
                    </div>
                    <div class="col-md-3 text-end pe-4">
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">🗑 Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-end mt-4">
            <h4><strong>💰 Prix total : {{ $total }} MAD</strong></h4>

            <div class="mt-3">
                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary me-2">Vider le panier</button>
                </form>

                <form action="{{ route('checkout') }}" method="GET" class="d-inline">
                    <button type="submit" class="btn btn-success">Passer au paiement</button>
                </form>
            </div>
        </div>
    @endif
    
</div>
@endsection
