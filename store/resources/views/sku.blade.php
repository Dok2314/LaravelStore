@extends('layouts.master')

@section('title', 'Товар')

@section('content')
    <h1>{{ $sku->product->__('name') }}</h1>
    <h2>{{ $sku->product->category->name }}</h2>
    <p>Цена: <b>{{ $sku->price }} {{ $currencySymbol }}</b></p>

    @isset($sku->product->properties)
        @foreach($sku->propertyOptions as $propertyOption)
            <h4>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h4>
        @endforeach
    @endisset

    <img src="{{ \Illuminate\Support\Facades\Storage::url($sku->product->image) }}">
    <p>{{ $sku->product->description }}</p>
        @if($sku->isAvailable())
            <form action="{{ route('basket-add', $sku->product) }}" method="post">
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
            <form action="{{ route('subscription', $sku) }}" method="post">
                @csrf
                <input type="email" placeholder="examle@gmail.com" name="email">
                <button type="submit">Отправить</button>
                @error('email')
                <div class="texte text-danger">{{ $message }}</div>
                @enderror
            </form>
        @endif
@endsection
