Dear client, product {{ $sku->name }} is available in count: {{ $sku->count }};

<a href="{{ route('product', [$sku->category->slug, $sku->slug]) }}">See more</a>
