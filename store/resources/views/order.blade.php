@extends('layouts.master')

@section('title', 'Оформить заказ')

@section('content')
    <h1>Подтвердите заказ:</h1>
    <div class="container">
        <div class="row justify-content-center">
            <p>Общая стоимость заказа: <b> {{ $order->getFullSum() }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</b></p>
            <form action="{{ route('basket-confirm') }}" method="POST">
                @csrf
                <div>
                    <p>Укажите свой номер телефона, чтобы наш менеджер мог с вами связаться:</p>

                    <div class="container">
                        <div class="form-group">
                            <label for="email" class="control-label col-lg-offset-3 col-lg-2">Email: </label>
                            <div class="col-lg-4">
                                <input type="email" name="email" id="email" value="" class="form-control" placeholder="example@gmail.com">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="container">
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Номер
                                телефона: </label>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" value="Подтвердить заказ">
                </div>
            </form>
        </div>
    </div>
@endsection
