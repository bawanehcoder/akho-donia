<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-text">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('asset-files/imgs/logo.png') }}" alt="Company Logo" width="150" height="50" />

        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">الرئيسية</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('mainshop') }}" >
                        المتجر
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('about-us')}}">من نحن</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('our_branches.show') }}">الفروع</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">كتالوج</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">فيديوهات خاصة</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('contact_us.show')}}">تواصل معنا</a>
                </li>

            </ul>
            <a href="{{ route('login') }}" class="login-button">تسجيل الدخول</a>

        </div>
    </div>
</nav>