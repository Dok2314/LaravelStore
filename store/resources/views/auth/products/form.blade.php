@extends('auth.layouts.master')

@isset($product)
    @section('title', 'Редактировать товар ' . $product->__('name'))
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактировать товар <b>{{ $product->__('name') }}</b></h1>
        @else
            <h1>Добавить товар</h1>
        @endisset
        <form method="POST" enctype="multipart/form-data"
              @isset($product)
              action="{{ route('products.update', $product) }}"
              @else
              action="{{ route('products.store') }}"
            @endisset
        >
            <div>
                @isset($product)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6" style="margin-left: 7px;">
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{ old('name') }}@isset($product){{ $product->name }}@endisset" style="width: 500px;">
                        @include('auth.layouts.error', ['fieldName' => 'name'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name_en" class="col-sm-2 col-form-label">Название английское: </label>
                    <div class="col-sm-6" style="margin-left: 7px;">
                        <input type="text" class="form-control" name="name_en" id="name_en"
                               value="{{ old('name_en') }}@isset($product){{ $product->name_en }}@endisset" style="width: 500px;">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Slug: </label>
                    <div class="col-sm-6" style="margin-left: 7px;">
                        <input type="text" class="form-control" name="slug" id="slug"
                               value="{{ old('slug') }}@isset($product){{ $product->slug }}@endisset" style="width: 500px;">
                        @include('auth.layouts.error', ['fieldName' => 'slug'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                    <div class="col-sm-6" style="margin-left: 25px; width: 400px;">
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @isset($product)
                                        {{ $category->id == $product->category->id ? 'selected' : '' }}
                                    @endisset
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @include('auth.layouts.error', ['fieldName' => 'category_id'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
								<textarea name="description" id="description" cols="72"
                                          rows="7">{{ old('description') }}@isset($product){{ $product->description }}@endisset
                                </textarea>
                        @include('auth.layouts.error', ['fieldName' => 'description'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description_en" class="col-sm-2 col-form-label">Описание английское: </label>
                    <div class="col-sm-6">
                            <textarea name="description_en" id="description_en" cols="72"
                                      rows="7">{{ old('description_en') }}@isset($product){{ $product->description_en }}@endisset
                            </textarea>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file" style="margin-right: 450px;">
                            Загрузить <input type="file" style="display: none;" name="image" id="image">
                        </label>
                    </div>
                </div>
                <br>

                <div class="input-group row">
                    <label for="property" class="col-sm-2 col-form-label">Свойства товара: </label>
                    <div class="col-sm-6" style="margin-left: 25px; width: 400px;">
                        <select name="property_id[]" multiple>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}"
                                @isset($product)
                                    @if($product->properties->contains($property->id))
                                        selected
                                    @endif
                                @endisset
                                >{{ $property->name }}</option>
                            @endforeach
                        </select>
                        @include('auth.layouts.error', ['fieldName' => 'property_id[]'])
                    </div>
                </div>

                <br>
                @foreach([
                    'hit' => __('main.product_types.hit'),
                    'new' => __('main.product_types.new'),
                    'recommend' => __('main.product_types.recommend'),
                ] as $field => $title)
                    <div class="input-group row">
                        <div class="form-group">
                            <label for="{{ $field }}">{{ $title }}: </label>
                            <input type="checkbox" name="{{ $field }}" id="{{ $field }}"
                                   @if(isset($product) && $product->$field === 1)
                                       checked="checked"
                                   @endif
                            >
                        </div>
                       @include('auth.layouts.error', ['fieldName' => $field])
                    </div>
                @endforeach
                <hr>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
