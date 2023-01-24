@extends('auth.layouts.master')

@section('title', 'Купон ' . $coupon->code)

@section('content')
    <div class="col-md-12">
        <h1>{{ $coupon->code }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $coupon->id}}</td>
            </tr>
            <tr>
                <td>Code</td>
                <td>{{ $coupon->code }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $coupon->description }}</td>
            </tr>
            @if($coupon->currency)
                <tr>
                    <td>Валюта</td>
                    <td>{{ $coupon->currency->slug }}</td>
                </tr>
            @endif
            <tr>
                <td>Абсолютное значение</td>
                <td>@if($coupon->isAbsolute()) Да @else Нет @endif</td>
            </tr>
            <tr>
                <td>Использовать один раз</td>
                <td>@if($coupon->isOnlyOnce()) Да @else Нет @endif</td>
            </tr>
            <tr>
                <td>Использован</td>
                <td>{{ $coupon->orders->count() }}</td>
            </tr>
            <tr>
                <td>Действителен до</td>
                <td>{{ $coupon->expired_at->toDateString() }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
