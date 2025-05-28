@extends('layouts.app')

@section('title', $product->name)

@section('content')
<h1>{{ $product->name }}</h1>
<p>{{ $product->description }}</p>
<p>Prix : {{ $product->price }} MAD</p>
@if ($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" width="200">
@endif
@endsection
