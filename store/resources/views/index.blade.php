@extends('layouts.master')

@section('title', __('main.main_page'))

@section('content')
    <div style="margin-right: 90px;">
        @include('auth.layouts.error', ['fieldName' => 'price_to'])
        @include('auth.layouts.error', ['fieldName' => 'price_from'])
    </div>
    <h1>@lang('main.all_products')</h1>

    <form method="GET" action="{{route("index")}}">
        <div class="filters row">
            <div class="col-sm-6 col-md-3">
                <label for="price_from">@lang('main.price_from')
                    <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from}}">
                </label>
                <label for="price_to">@lang('main.price_to')
                    <input type="text" name="price_to" id="price_to" size="6"  value="{{ request()->price_to }}">
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="hit">
                    <input type="checkbox" name="hit" id="hit" @if(request()->has('hit')) checked @endif> @lang('main.product_types.hit')
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="new">
                    <input type="checkbox" name="new" id="new" @if(request()->has('new')) checked @endif> @lang('main.product_types.new')
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="recommend">
                    <input type="checkbox" name="recommend" id="recommend" @if(request()->has('recommend')) checked @endif> @lang('main.product_types.recommend')
                </label>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-primary">@lang('main.filter')</button>
                <a href="{{ route("index") }}" class="btn btn-warning">@lang('main.reset_filter')</a>
            </div>
        </div>
    </form>
    <hr>
    <div class="row">
        @foreach($products as $product)
            @include('layouts.card', compact('product'))
        @endforeach
    </div>
    {{ $products->withQueryString()->links('vendor.pagination.bootstrap-4') }}
@endsection
