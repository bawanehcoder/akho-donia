@extends('site.layout.master')
@section('title')
    {{ trans('general.products') }}
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li><a href="{{ route('products.index') }}">@langucw('Product')</a></li>
    <li>{{ $product->getTitle() }}</li>
@endsection
@section('content')
    <div class="main-wrapper">
        <div class="container">
            <div class="product">
                <div class="product-images">
                    <img alt="product" height="500" src="{{ $product->getFirstMediaUrl('products', 'full') }}"
                        width="500" />
                    {{-- <div class="thumbnails">
                    <img alt="product " height="100"
                        src="RFO-1400x919-TropicalTrifle-28e410b2-02fa-4089-9f5a-1100aba60efa-0-1400x919 (7).png"
                        width="100" />
                    <img alt="product " height="100"
                        src="RFO-1400x919-TropicalTrifle-28e410b2-02fa-4089-9f5a-1100aba60efa-0-1400x919 (8).png"
                        width="100" />
                    <img alt="product " height="100"
                        src="RFO-1400x919-TropicalTrifle-28e410b2-02fa-4089-9f5a-1100aba60efa-0-1400x919 (9).png"
                        width="100" />
                </div> --}}
                </div>
                <div class="product-details">
                    <h1>
                        {{ $product->getTitle() }}
                    </h1>
                    <div class="price">
                        {{ $product->price() }} {{ $genralSetting->getCurrency() }}
                    </div>
                    <p>
                        {!! $product->Description !!}
                    </p>
                    @php
                        $options = $product->optionDetil->groupBy('POptID');
                    @endphp
                    @if (count($options))
                        @include('components.product-option-detil', ['options' => $options])
                    @endif
                    <div class="add-to-cart-div">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="quantity">
                                    <div class="btns-plus">
                                        <button class="mins">-</button>
                                        <button class="plus">+</button>
                                    </div>
                                    <input type="text" value="2" name="qty" id="qty">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <button class="add-to-cart-btn" href="javaScript:void(0)"
                                    onclick="addToCart({{ $product->id }})">
                                    أضف للسلة
                                </button>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">الوصف</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">معلومات إضافية</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    {!! $product->Description !!}
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            </div>





        </div>
    </div>
@endsection
