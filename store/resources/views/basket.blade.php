@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    <h1>Корзина</h1>
    <p>Оформление заказа</p>
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Название</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Стоимость</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products()->with('category')->get() as $product)
                <tr>
                    <td>
                        <a href="{{ route('product', [$product->category->slug, $product->slug]) }}">
                            <img height="56px" src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}">
                            {{ $product->__('name') }}
                        </a>
                    </td>
                    <td><span class="badge">{{ $product->pivot->count }}</span>
                        <div class="btn-group form-inline">
                            <form action="{{ route('basket-remove', $product) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger" href="">
                                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                </button>
                            </form>

                            <form action="{{ route('basket-add', $product) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>{{ $product->price }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</td>
                    <td>{{ $product->getPriceForCount() }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">Общая стоимость:</td>
                <td>{{ $order->getFullSum() }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</td>
            </tr>
            </tbody>
        </table>
        <br>
        @if($order->products->count() > 0)
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success" href="{{ route('basket-place') }}">Оформить заказ</a>
            </div>
        @endif
    </div>
@endsection
