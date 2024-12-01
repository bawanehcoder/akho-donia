@extends('site.layout.master')
@section('title')
@endsection
@section('css')
@endsection
@section('breadcrumb')
@endsection
@php $home='home'; @endphp
@section('content')


<section class="home-slider">
    <div class="main-slider">
        @foreach ($sliders as $slider)
        <div class="slider-item">
            <img src="{{ asset( $slider->getFirstMediaUrl('slider','full') ) }}" alt="Slide 1" />
            <div class="slider-content">
                <img src="{{ asset('asset-files/imgs/slider/logo.png') }}" alt="" class="slider-logo">
                <h1>{{ $slider->title }}</h1>
                <p>{{ $slider->url }}</p>
                <a href="{{ route('mainshop') }}" class="slider-btn">تسوق الان </a>
            </div>
            <img src="{{ asset( $slider->getFirstMediaUrl('layer1','full') ) }}" alt="" data-aos="fade-up-right"
                data-aos-duration="1000" class="layer1 slide-layer">
            <img src="{{ asset( $slider->getFirstMediaUrl('layer2','full') ) }}" alt="" data-aos="fade-down-left"
                data-aos-duration="1000" class="layer2 slide-layer">
            <img src="{{ asset( $slider->getFirstMediaUrl('layer3','full') ) }}" alt="" data-aos="fade-down-right"
                data-aos-duration="1000" class="layer3 slide-layer">
        </div>
        @endforeach
        

    </div>
</section>

@endsection
@section('scripts')
@endsection
