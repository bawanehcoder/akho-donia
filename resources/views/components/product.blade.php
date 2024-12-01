@if ($product)
    @php
        $discount = app()
            ->make(\App\Services\DiscountService::class)
            ->getDiscountByItem($product);
    @endphp


    <div class="col-md-4">
        <div class="product-card ">
            <a href="{{ route('products.show', $product) }}">
                <div class="product-img-wrapper">
                    <img alt="cupcake" height="200" src="{{ asset($product->getFirstMediaUrl('products', 'full')) }}"
                        width="250" />
                    <span class="add-to-cart" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-shopping-cart"></i>
                        <span>اضف الى السلة</span>
                    </span>
                </div>

                <div class="card-content">
                    <p class="price">{{ $product->price() }} {{ $genralSetting->getCurrency() }}</p>
                    <h3>{{ $product->getTitle() }}</h3>
                </div>
            </a>
        </div>
    </div>
@endif
