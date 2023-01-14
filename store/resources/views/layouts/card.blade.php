<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($product->isNew())
                <span class="badge badge-success">@lang('main.product_types.new')</span>
            @endif
            @if($product->isRecommend())
                    <span class="badge badge-warning">@lang('main.product_types.recommend')</span>
            @endif
            @if($product->isHit())
                    <span class="badge badge-danger">@lang('main.product_types.hit')</span>
            @endif
        </div>
        <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="">
        <div class="caption">
            <h3>{{ $product->__('name') }}</h3>
            <p>{{ $product->price }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</p>
            <p>
                <form action="{{ route('basket-add', $product) }}" method="post">
                    @csrf
                @if($product->isAvailable())
                    <button type="submit" class="btn btn-primary" role="button">@lang('main.to_basket')</button>
                @else
                    Не доступен
                @endif
                    <a href="{{ route('product', [$product->category, $product]) }}" class="btn btn-default"
                       role="button">@lang('main.more')</a>
                </form>
            </p>
        </div>
    </div>
</div>
