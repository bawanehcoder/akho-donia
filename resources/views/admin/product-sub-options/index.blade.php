@extends('admin.layout.master')
@section('title')
    {{ trans('general.sub_options') }}
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.product-options.index') }}">{{ trans('general.products_categories') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('general.product_options') }}</li>
    <li class="breadcrumb-item active">{{ trans('general.sub_options') }}</li>
@endsection
@section('content')
    @include('components.messagesAndErrors')
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class=" card table-list-card">

                    <div class="table-top">
                        <div class="search-set">


                            <div class="search-input">
                                <a href="javascript:void(0);" class="btn btn-searchset"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg></a>

                            </div>

                            <div class="f-input">

                                <select name="OptID" autocomplete="off" id="OptID" class="select basic_options w-100">
                                    @foreach ($basic_options ?? [] as $option)
                                        <option value="{{ $option->id }}">{{ $option->Name }}
                                            | {{ $option->NameEN }} </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="search-path">

                        </div>
                        <div class="form-sort">
                        </div>
                    </div>
                    <div class=" card-body table-list-card-body">
                        <div class="table-responsive product-list">

                            <table class=" table no-footerdata-table  data-table">
                                <thead>
                                    <tr>
                                        <th>{{ trans('general.id') }}</th>
                                        <th>@langucw('the image')</th>
                                        <th>{{ trans('general.name_ar') }}</th>
                                        <th>{{ trans('general.name_en') }}</th>
                                        <th>{{ trans('general.available') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                bFilter: true,
                sDom: 'fBtlpi',
                ordering: true,
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: "Search",
                    info: "_START_ - _END_ of _TOTAL_ items",
                    paginate: {
                        next: ' <i class=" fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i> '
                    },
                },
                initComplete: (settings, json) => {
                    $('.dataTables_filter').appendTo('#tableSearch');
                    $('.dataTables_filter').appendTo('.search-input');

                },
                ajax: {
                    url: "{{ route('dashboard.product-sub-options.index') }}",
                    data: function(d) {
                        d.basic_options = $('.basic_options').val()
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'Name',
                        name: 'name'
                    },
                    {
                        data: 'NameEN',
                        name: 'NameEN'
                    },
                    {
                        data: 'Available',
                        name: 'Available'
                    },
                ],

            });
            $(".basic_options").change(function() {
                table.draw();
            });
        });

        var select_box_element = document.querySelector('#OptID');

        dselect(select_box_element, {
            search: true
        });
    </script>
@endsection
