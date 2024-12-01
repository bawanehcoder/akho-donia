<!DOCTYPE html>
<html lang="ar" dir="rtl">


@include('site.layout.head')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@include('components.head-script')


<body>

@include('site.layout.header')


@yield('content')


@include('site.layout.footer')


    <!-- Add to Cart -->
    <div class="modal  fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="cart-modal-head">
                        <div>
                            <div class="product-name">اسم الصنف</div>
                            <div class="product-price">25$</div>
                        </div>
                        <div class="quantity">
                            <div class="btns-plus">
                                <button class="mins">-</button>
                                <button class="plus">+</button>
                            </div>
                            <input type="text" value="2">
                        </div>
                    </div>
                    <div class="mb-3">
                        <select id="disabledSelect" class="form-select">
                            <option>الحجم</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select id="disabledSelect" class="form-select">
                            <option>النكهة</option>
                        </select>
                    </div>

                    <button class="button button-primary">مشاهدة السلة</button>
                    <button class="button button-secondary">متابعة الشراء</button>
                </div>

            </div>
        </div>
    </div>
</body>

@include('site.layout.footer-scripts')

</html>
