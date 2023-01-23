<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($sku->product->isNew())
                <span class="badge badge-success">@lang('main.product_types.new')</span>
            @endif
            @if($sku->product->isRecommend())
                    <span class="badge badge-warning">@lang('main.product_types.recommend')</span>
            @endif
            @if($sku->product->isHit())
                    <span class="badge badge-danger">@lang('main.product_types.hit')</span>
            @endif
        </div>
        <img src="{{ \Illuminate\Support\Facades\Storage::url($sku->product->image) }}" alt="{{ $sku->product->__('name') }}">
        <div class="caption">
            <h3>{{ $sku->product->__('name') }}</h3>
            @isset($sku->product->properties)
                @foreach($sku->propertyOptions as $propertyOption)
                    <h4>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h4>
                @endforeach
            @endisset
            <p>{{ $sku->price }} {{ $currencySymbol }}</p>
            <p>
                <form action="{{ route('basket-add', $sku) }}" method="post">
                    @csrf
                @if($sku->isAvailable())
                    <button type="submit" class="btn btn-primary" role="button">@lang('main.to_basket')</button>
                @else
                    Не доступен
                @endif
                    <a href="{{ route('sku',
                                [$sku->product->category, $sku->product, $sku]
                                ) }}" class="btn btn-default"
                       role="button">@lang('main.more')</a>
                </form>
            </p>
        </div>
    </div>
</div>
