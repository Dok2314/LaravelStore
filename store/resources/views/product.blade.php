@extends('layouts.master')

@section('title', 'Товар')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Цена: <b>{{ $product->price }} руб.</b></p>
    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}">
    <p>{{ $product->description }}</p>
    <form action="{{ route('basket-add', $product) }}" method="post">
        @csrf
        @if($product->isAvailable())
            <button type="submit" class="btn btn-success" role="button">В корзину</button>
        @else
            Не доступен
        @endif
    </form>
@endsection
