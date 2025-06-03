@extends('layouts.app')

@section('title', 'Paiement')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-4 text-center">💳 Confirmation de la commande</h1>

        @if (empty($cart))
            <div class="alert alert-info">Votre panier est vide.</div>
        @else
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">🛍 Récapitulatif de la commande</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($cart as $item)
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        @if (!empty($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid rounded"
                                                alt="{{ $item['name'] }}">
                                        @else
                                            <img src="https://via.placeholder.com/100x100?text=No+Image"
                                                class="img-fluid rounded" alt="No Image">
                                        @endif
                                    </div>
                                    <div class="col-md-7">
                                        <strong>{{ $item['name'] }}</strong><br>
                                        Quantité : {{ $item['quantity'] }}
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <strong>{{ $item['price'] * $item['quantity'] }} MAD</strong>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4 text-end">
                        <h4><strong>💰 Total à payer : {{ $total }} MAD</strong></h4>
                    </div>
                </div>
            </div>

            <!--  <form method="POST" action="{{ route('checkout') }}" class="text-end">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg">
                    ✅ Payer maintenant
                </button>
            </form> -->
            <form action="{{ route('payzone.launch') }}" method="POST">
                @csrf
                <div class="mt-3">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Nom complet" required>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                    <button type="submit" class="btn btn-primary w-100">Procéder au paiement</button>
                </div>
            </form>
        @endif

    </div>
@endsection
