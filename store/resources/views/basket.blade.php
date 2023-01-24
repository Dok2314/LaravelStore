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
            @foreach($order->skus as $sku)
                <tr>
                    <td>
                        <a href="{{ route('sku', [$sku->product->category->slug, $sku->product->slug, $sku]) }}">
                            <img height="56px" src="{{ \Illuminate\Support\Facades\Storage::url($sku->product->image) }}">
                            {{ $sku->product->__('name') }}
                        </a>
                    </td>
                    <td><span class="badge">{{ $sku->countInOrder }}</span>
                        <div class="btn-group form-inline">
                            <form action="{{ route('basket-remove', $sku) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger" href="">
                                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                </button>
                            </form>

                            <form action="{{ route('basket-add', $sku) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>{{ $sku->price }} {{ $currencySymbol }}</td>
                    <td>{{ $sku->price * $sku->countInOrder }} {{ $currencySymbol }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">Общая стоимость:</td>
                @if($order->hasCoupon())
                    <td>
                        <strike>{{ $order->getFullSum(false) }}</strike>
                        <b>{{ $order->getFullSum() }}</b>
                        {{ $currencySymbol }}
                    </td>
                @else
                    <td>{{ $order->getFullSum() }} {{ $currencySymbol }}</td>
                @endif
            </tr>
            </tbody>
        </table>
        @if(!$order->hasCoupon())
            <div class="row">
                <div class="form-inline pull-right">
                    <form method="POST" action="{{ route('set-coupon') }}">
                        @csrf
                        <label for="">Добавить купон</label>
                        <input type="text" class="form-control" name="coupon">
                        <button type="submit" class="btn btn-success">Применить</button>
                    </form>
                    <div>
                        @error('coupon')
                        <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        @else
            <div>Вы используете купон {{ $order->coupon->code }}</div>
        @endif
        <br>
        @if($order->skus->count() > 0)
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success" href="{{ route('basket-place') }}">Оформить заказ</a>
            </div>
        @endif
    </div>
@endsection
