<!DOCTYPE html>
<html class="no-js" lang="{{ \Config::get('app.locale') == 'en' ? 'en' : 'ar' }}"
    dir="{{ \Config::get('app.locale') == 'en' ? 'ltr' : 'rtl' }}">

<head>
    @php  $verastion=\Config::get('setting.verastion'); @endphp
    @include('site.layout.head')
    @include('components.head-script')
    @include('site.layout.search')
</head>


<body>
    <form style='display: none;' id='delete-form' action="" method="post">
        @csrf
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    @include('components.offcanvas-cart')
    @include('site.layout.header')

    @if(!isset($home))
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul class="breadcrumb_list">
                            @yield('breadcrumb')
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->
@endif
    @yield('content')






    @include('site.layout.footer')

    @include('site.layout.footer-scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
    <script src="assets/js/home.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll('.joy-section img, .joy-section .btn-primary');

            elements.forEach(el => {
                el.style.opacity = 0;
                el.style.transition = 'opacity 1s ease-in-out';
            });

            window.addEventListener('scroll', () => {
                elements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                        el.style.opacity = 1;
                    }
                });
            });
        });
    </script>

</body>

</html>
