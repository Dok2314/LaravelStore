@extends('auth.layouts.master')

@isset($category)
    @section('title', 'Редактировать категорию ' . $category->name)
@else
    @section('title', 'Создать категорию')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($category)
            <h1>Редактировать Категорию <b>{{ $category->name }}</b></h1>
        @else
            <h1>Добавить Категорию</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data" class="form-group"
              @isset($category)
              action="{{ route('categories.update', $category) }}"
              @else
              action="{{ route('categories.store') }}"
            @endisset
        >
            <div>
                @isset($category)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" id="name" style="margin-left: 20px; width: 500px;"
                               value="{{ old('name') }}@isset($category){{ $category->name }}@endisset">
                        @include('auth.layouts.error', ['fieldName' => 'name'])
                    </div>
                </div>
                <br>
                    <div class="input-group row">
                        <label for="slug" class="col-sm-2 col-form-label">Slug: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="slug" id="slug" style="margin-left: 20px; width: 500px;"
                                   value="{{ old('slug') }}@isset($category){{ $category->slug }}@endisset">
                            @include('auth.layouts.error', ['fieldName' => 'slug'])
                        </div>
                    </div>
                    <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
							<textarea name="description" id="description" cols="72"
                                      rows="7">{{ old('description') }}@isset($category){{ $category->description }}@endisset
                            </textarea>
                        @include('auth.layouts.error', ['fieldName' => 'description'])
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
                <hr>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
