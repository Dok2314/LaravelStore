@extends('auth.layouts.master')

@isset($coupon)
    @section('title', 'Редактировать товар ' . $coupon->code)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($coupon)
            <h1>Редактировать купон <b>{{ $coupon->code }}</b></h1>
        @else
            <h1>Добавить купон</h1>
        @endisset
        <form method="POST" enctype="multipart/form-data"
              @isset($coupon)
              action="{{ route('coupons.update', $coupon) }}"
              @else
              action="{{ route('coupons.store') }}"
            @endisset
        >
            <div>
                @isset($coupon)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Code: </label>
                    <div class="col-sm-6" style="margin-left: 7px;">
                        <input type="text" class="form-control" name="code" id="code"
                               value="{{ old('code') }}@isset($coupon){{ $coupon->code }}@endisset" style="width: 500px;">
                        @include('auth.layouts.error', ['fieldName' => 'code'])
                    </div>
                </div>
                <br>
                    <div class="input-group row">
                        <label for="slug" class="col-sm-2 col-form-label">Номинал: </label>
                        <div class="col-sm-6" style="margin-left: 7px;">
                            <input type="text" class="form-control" name="value" id="value"
                                   value="{{ old('value') }}@isset($coupon){{ $coupon->value }}@endisset" style="width: 500px;">
                            @include('auth.layouts.error', ['fieldName' => 'value'])
                        </div>
                    </div>
                    <br>
                    <div class="input-group row">
                        <label for="currency_id" class="col-sm-2 col-form-label">Валюта: </label>
                        <div class="col-sm-6" style="margin-left: 25px; width: 400px;">
                            <select name="currency_id" id="currency_id" class="form-control">
                                <option value="">Без валюты</option>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}"
                                        @if($coupon && $coupon->currency)
                                            {{ $currency->id == $coupon->currency->id ? 'selected' : '' }}
                                        @endif
                                    >
                                        {{ $currency->slug }}
                                    </option>
                                @endforeach
                            </select>
                            @include('auth.layouts.error', ['fieldName' => 'currency_id'])
                        </div>
                    </div>
                    <br>
                @foreach([
                    'type' => __('main.coupon_types.type'),
                    'only_once' => __('main.coupon_types.only_once'),
                ] as $field => $title)
                    <div class="input-group row">
                        <div class="form-group">
                            <label for="{{ $field }}">{{ $title }}: </label>
                            <input type="checkbox" name="{{ $field }}" id="{{ $field }}"
                                   @if(isset($coupon) && $coupon->$field === 1)
                                       checked="checked"
                                   @endif
                            >
                        </div>
                       @include('auth.layouts.error', ['fieldName' => $field])
                    </div>
                @endforeach
                <br>
                <div class="input-group row">
                    <label for="expired_at" class="col-sm-2 col-form-label">Использовать до: </label>
                    <div class="col-sm-6" style="margin-left: 7px;">
                        <input type="date" class="form-control" name="expired_at" id="expired_at"
                               value="{{ old('expired_at') }}@isset($coupon){{ $coupon->expired_at->toDateString() }}@endisset" style="width: 500px;">
                        @include('auth.layouts.error', ['fieldName' => 'expired_at'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                            <textarea name="description" id="description" cols="72"
                                      rows="7">{{ old('description') }}@isset($coupon){{ $coupon->description }}@endisset
                            </textarea>
                        @include('auth.layouts.error', ['fieldName' => 'description'])
                    </div>
                </div>
                <hr>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
