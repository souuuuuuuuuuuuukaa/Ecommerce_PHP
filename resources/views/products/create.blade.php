@extends('layouts.app')

@section('title', 'Ajouter un produit')

@section('content')
<h1>Ajouter un produit</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <label>Nom du produit</label>
    <input type="text" name="name"><br><br>

    <label>Description</label>
    <textarea name="description"></textarea><br><br>

    <label>Prix (MAD)</label>
    <input type="text" name="price"><br><br>

    <label>Image</label>
    <input type="file" name="image"><br><br>

    <button type="submit">Ajouter</button>
</form>
@endsection
