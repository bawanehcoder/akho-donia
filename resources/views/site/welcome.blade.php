@extends('site.layout.master')
@section('title')
@endsection
@section('css')
@endsection
@section('breadcrumb')
@endsection
@php $home='home'; @endphp
@section('content')
    <div class="main-slider">
        <div class="single-slider">
            <img src="{{ asset('assets/slider.png') }}" alt="slider">
            <div class="slider-text">
                <h1 data-aos="fade-down" data-aos-delay="500">Cooking. Tasting. Living</h1>
                <a data-aos="fade-up" data-aos-delay="500" class="btn btn-primary">Check Our Menu</a>
            </div>
        </div>
    </div>

    <section class="main-lines">
        <div class="container">
            <h1 class="mainlinetitle">
                Our Service
            </h1>
            <div class="row ll">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6" data-aos="fade-right" data-aos-delay="500">
                            <img src="{{ asset('assets/l1.png') }}" alt="">
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-delay="500">
                            <div class="lin">
                                <h3>Cake</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged</p>
                                <a class="btn btn-primary" href="{{ route('mainshop') }}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6" data-aos="fade-right" data-aos-delay="500">
                            <div class="lin lc">
                                <h3>Restaurant</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged</p>
                                <a class="btn btn-primary" href="{{ route('mainshop') }}">Shop Now</a>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-delay="500">
                            <img src="{{ asset('assets/l2.png') }}" alt="">
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6" data-aos="fade-right" data-aos-delay="500">
                            <img src="{{ asset('assets/l3.png') }}" alt="">
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-delay="500">
                            <div class="lin">
                                <h3>Cookies</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged</p>
                                <a class="btn btn-primary" href="{{ route('mainshop') }}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6" data-aos="fade-right" data-aos-delay="500">
                            <div class="lin lc">
                                <h3>Organizing parties</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged</p>
                                <a class="btn btn-primary" href="{{ route('mainshop') }}">Shop Now</a>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-delay="500">
                            <img src="{{ asset('assets/l4.png') }}" alt="">
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="about">
        <div class="container">
            <h1 class="mainlinetitle" data-aos="fade-down" data-aos-delay="500">
                About Us
            </h1>
            <p data-aos="fade-left" data-aos-delay="500">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
                electronic typesetting, remaining essentially unchanged
            </p>
            <img data-aos="fade-right" data-aos-delay="500" src="{{ asset('assets/st.png') }}" alt="">
        </div>

    </section>

   


    <a class="fixedshop" href="{{ route('mainshop') }}"><span>@langucw('shop')</span></a>
@endsection
@section('scripts')
@endsection
