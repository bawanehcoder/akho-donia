@extends('admin.layout.master')
@section('title')
    {{trans('general.create')}} {{trans('general.basic_options')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{route('dashboard.product-options.index')}}">{{trans('general.products_categories')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.product_options')}}</li>
    <li class="breadcrumb-item active">{{trans('general.basic_options')}}</li>
@endsection

@section('content')

    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.product-options.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="product-options">
            <input type="hidden" class="custom-file-input" name="type" id="type" value="0">
            <div class=" card table-list-card>
                <div class=" card-body table-list-card-body">
                    <div class="form-row ">
                        <div class="form-group col-md-6">
                            <label for="name_ar">{{trans('general.name_ar')}}</label>
                            <input type="text" name="name_ar" value="{{old('name_ar')}}" id="name_ar"
                                   class="form-control">
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="name_en">{{trans('general.name_en')}}</label>
                            <input type="text" name="name_en" value="{{old('name_en')}}" id="name_en"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-3 ">
                        <button type="submit" class="btn btn-danger">{{trans('general.save')}}</button>
                        <a href="{{route('dashboard.product-options.index' )}}" class="btn btn-default">{{trans('general.back')}}</a>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
@section('scripts') @endsection
