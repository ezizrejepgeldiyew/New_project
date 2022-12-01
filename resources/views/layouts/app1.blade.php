<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>


<body>

    <header id="header" class="header fixed-top d-flex align-items-center">


        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('index') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>


        <nav class="header-nav ms-auto">

            <span class="d-none d-md-block">{{ Auth::user()->name }}</span>

        </nav>

    </header>


    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="@if (Request::routeIs('adminindex')) nav-link @else
                nav-link collapsed @endif "
                    href="{{ route('adminindex') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Products</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('category.index') }}">
                            <i class="bi bi-circle"></i><span>Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ourbrand.index') }}">
                            <i class="bi bi-circle"></i><span>Our Brand</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">
                            <i class="bi bi-circle"></i><span>Product</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#orders" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Zakazlar</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="orders" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="">
                        <a href="{{ route('orders_false') }}">
                            <i class="bi bi-circle"></i>
                            <span>Ugradylmadyk</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ route('orders_true') }}">
                            <i class="bi bi-circle"></i>
                            <span>Ugradylan</span>
                        </a>
                    </li>

                </ul>


            </li>

            <li class="nav-item">
                <a href="{{ route('discount_product.index') }}"
                    class="@if (Request::routeIs('discount_product.index')) nav-link @else
                nav-link collapsed @endif">
                    <i class="bi bi-box"></i>
                    <span>Arzanlaşyk</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('money_cours.index') }}"
                    class="@if (Request::routeIs('money_cours.index')) nav-link @else
                nav-link collapsed @endif">
                    <i class="bi bi-box"></i>
                    <span>Kurslar</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('online_users') }}"
                    class="@if (Request::routeIs('online_users')) nav-link @else
                nav-link collapsed @endif">
                    <i class="bi bi-box"></i>
                    <span>Ulgamdaky ulanyjylar</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('product_downloads.index') }}"
                    class="@if (Request::routeIs('product_downloads.index')) nav-link @else
                nav-link collapsed @endif">
                    <i class="bi bi-box"></i>
                    <span>Harytlaryň statistikasy</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('notices.index') }}"
                    class="@if (Request::routeIs('notices.index')) nav-link @else
                nav-link collapsed @endif">
                    <i class="bi bi-box"></i>
                    <span>Bildirişler</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link collapsed"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="bi bi-box-arrow-in-right"></i>Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </aside>


    @yield('skilet')

    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>



    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
    <script src="{{ asset('js/previewImg.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    @yield('show_photo')
    @yield('checkbox_jquery')
</body>

</html>
