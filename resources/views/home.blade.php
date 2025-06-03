@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <div class="container mt-4">

        <!-- CAROUSEL -->
        <div id="homeCarousel" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel" data-bs-interval="2000"
            style="max-width: 900px; margin:auto;">
            <div class="carousel-inner rounded shadow" style="height: 450px;">
                <div class="carousel-item active">
                    <img src="{{ asset('images/slide1.jpg') }}" class="card-img-top d-block w-100" alt="Promo 1"
                        style="height: 450px; object-fit: contain;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/slide2.jpg') }}" class="card-img-top d-block w-100" alt="Promo 2"
                        style="height: 450px; object-fit: contain;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/slide3.jpg') }}" class="card-img-top d-block w-100" alt="Promo 3"
                        style="height: 450px; object-fit: contain;">
                </div>
            </div>

            <!-- Contrôles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>

        <!-- CONTENU PRINCIPAL -->
        <div class="text-center">
            <p class="fs-5">Découvrez nos produits dès maintenant :</p>
            {{-- <a href="{{ route('payzone.launch') }}" class="btn btn-outline-primary btn-lg mt-3">
                Voir les produits
            </a> --}}
            <form action="{{ route('payzone.launch') }}" method="POST">
                @csrf
                <div class="mt-3">

                    <button type="submit" class="btn btn-primary w-100">Procéder au paiement</button>
                </div>
            </form>
        </div>
        
    </div>
@endsection
