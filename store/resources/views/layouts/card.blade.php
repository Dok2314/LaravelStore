<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }} руб.</p>
            <p>
                <form action="{{ route('basket-add', $product) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                    <a href="{{ route('product', [$product->category, $product]) }}" class="btn btn-default"
                       role="button">Подробнее</a>
                </form>
            </p>
        </div>
    </div>
</div>
