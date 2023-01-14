@extends('layouts.master')

@section('title', 'Товар')

@section('content')
    <h1>{{ $product->__('name') }}</h1>
    <p>Цена: <b>{{ $product->price }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</b></p>
    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}">
    <p>{{ $product->description }}</p>
        @if($product->isAvailable())
            <form action="{{ route('basket-add', $product) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-success" role="button">В корзину</button>
            </form>
        @else
            <span>
                Не доступен
            </span>
            <br>
            <span>
                Сообщить мне когда товар появится в наличии
            </span>
            <hr>
            <form action="{{ route('subscription', $product) }}" method="post">
                @csrf
                <input type="email" placeholder="examle@gmail.com" name="email">
                <button type="submit">Отправить</button>
                @error('email')
                <div class="texte text-danger">{{ $message }}</div>
                @enderror
            </form>
        @endif
@endsection
