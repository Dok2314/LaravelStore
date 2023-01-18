@extends('auth.layouts.master')

@isset($propertyOption)
    @section('title', 'Редактировать вариант свойства ' . $property->__('name'))
@else
    @section('title', 'Создать вариант свойства')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($propertyOption)
            <h1>Редактировать вариант свойство <b>{{ $propertyOption->name }}</b></h1>
        @else
            <h1>Добавить вариант свойства</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data" class="form-group"
              @isset($propertyOption)
                  action="{{ route('property-options.update', [$property, $propertyOption]) }}"
              @else
              action="{{ route('property-options.store', $property) }}"
            @endisset
        >
            <div>
                @isset($propertyOption)
                    @method('PUT')
                @endisset
                @csrf
                <div>
                    <h2>Свойство {{ $property->name }}</h2>
                </div>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" id="name" style="margin-left: 20px; width: 500px;"
                               value="{{ old('name') }}@isset($propertyOption){{ $propertyOption->name }}@endisset">
                    </div>
                </div>
                    @include('auth.layouts.error', ['fieldName' => 'name'])
                <br>
                <div class="input-group row">
                    <label for="name_en" class="col-sm-2 col-form-label">Название английское: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name_en" id="name_en" style="margin-left: 20px; width: 500px;"
                               value="{{ old('name_en') }}@isset($propertyOption){{ $propertyOption->name_en }}@endisset">
                    </div>
                </div>
                    @include('auth.layouts.error', ['fieldName' => 'name_en'])
                <hr>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
