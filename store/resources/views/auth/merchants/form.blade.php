@extends('auth.layouts.master')

@isset($property)
    @section('title', 'Редактировать поставщика ' . $property->__('name'))
@else
    @section('title', 'Создать поставщика')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($merchant)
            <h1>Редактировать Поставщика <b>{{ $merchant->name }}</b></h1>
        @else
            <h1>Добавить Поставщика</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data" class="form-group"
              @isset($merchant)
              action="{{ route('merchants.update', $merchant) }}"
              @else
              action="{{ route('merchants.store') }}"
            @endisset
        >
            <div>
                @isset($merchant)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Имя: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" id="name" style="margin-left: 20px; width: 500px;"
                               value="{{ old('name') }}@isset($merchant){{ $merchant->name }}@endisset">
                    </div>
                </div>
                    @include('auth.layouts.error', ['fieldName' => 'name'])
                    <br>
                    <div class="input-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email: </label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="email" id="email" style="margin-left: 20px; width: 500px;"
                                   value="{{ old('email') }}@isset($merchant){{ $merchant->email }}@endisset">
                        </div>
                    </div>
                    @include('auth.layouts.error', ['fieldName' => 'email'])
                <hr>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
