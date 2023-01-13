Dear client, product {{ $product->name }} is available in count: {{ $product->count }};

<a href="{{ route('product', [$product->category->slug, $product->slug]) }}">See more</a>
