<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/feather.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/apexcharts.min.js') }}" type="text/javascript"></script>
{{-- <script src="assets/chart-data.js" type="text/javascript"></script> --}}

<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/js/sweetalerts.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

<script src="{{ asset('assets/js/script.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/theme-script.js') }}" type="text/javascript"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src='{{asset('js/daterangepicker.js')}}'></script>

<script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script> --}}

<script>
        function deleteItem($url) {
            if (confirm('<?php echo e(__('Are you sure you want to delete this item?')); ?>')) {
                $('#delete-form').attr('action', $url);
                $('#delete-form').submit();
            }
        }
    
        $('.select-all').click(function() {
            let $select2 = $(this).parent().siblings('.select2');
            $select2.find('option').prop('selected', 'selected');
            $select2.trigger('change');
        });
        $('.deselect-all').click(function() {
            let $select2 = $(this).parent().siblings('.select2');
            $select2.find('option').prop('selected', '');
            $select2.trigger('change');
        });
    </script>
@yield('scripts')
