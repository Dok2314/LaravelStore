@extends('auth.layouts.master')

@isset($sku)
    @section('title', 'Редактировать sku')
@else
    @section('title', 'Создать sku')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($sku)
            <h1>Редактировать Sku <b>{{ $sku->name }}</b></h1>
        @else
            <h1>Добавить Свойство</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data" class="form-group"
              @isset($sku)
              action="{{ route('skus.update', [$product, $sku]) }}"
              @else
              action="{{ route('skus.store', $product) }}"
            @endisset
        >
            <div>
                @isset($sku)
                    @method('PUT')
                @endisset
                @csrf

                <div class="input-group row">
                    <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-2" style="width: 300px;">
                        @include('auth.layouts.error', ['fieldName' => 'price'])
                        <input type="text" class="form-control" name="price"
                               value="@isset($sku){{ $sku->price }}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="price" class="col-sm-2 col-form-label">Количество: </label>
                    <div class="col-sm-2" style="width: 300px; margin-right: 150px;">
                        @include('auth.layouts.error', ['fieldName' => 'count'])
                        <input type="text" class="form-control" name="count"
                               value="@isset($sku){{ $sku->count }}@endisset">
                    </div>
                </div>
                <br>

                @foreach($product->properties as $property)
                    <div class="input-group row">
                        <label for="property_id[{{ $property->id }}]" class="col-sm-2 col-form-label">{{ $property->name }}: </label>
                        <div class="col-sm-6" style="margin-left: 25px; width: 400px;">
                            <select name="property_id[{{ $property->id }}]" class="form-control">
                                @foreach($property->propertyOptions as $propertyOption)
                                    <option value="{{ $propertyOption->id }}"
                                    @isset($sku)
                                        {{ $sku->propertyOptions->contains($propertyOption->id) ? 'selected' : ''}}
                                    @endisset
                                    >{{ $propertyOption->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
                    <br>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
