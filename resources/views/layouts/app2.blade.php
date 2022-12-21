<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Electro - HTML Ecommerce Template</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link href="netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css1/bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css1/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css1/slick-theme.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css1/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css1/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css1/style.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="tel: {{ $aboutUs->phone }}" target="_blank()"><i class="fa fa-phone"></i>
                            {{ $aboutUs->phone }}</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> {{ $aboutUs->email }}</a></li>
                    <li><a href="https://maps.google.com/maps?q={{ $aboutUs->map }}" target="_blank()"><i
                                class="fa fa-map-marker"></i> {{ $aboutUs->map }}</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li> <select class="form-control changeLang">
                            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English
                            </option>
                            <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France
                            </option>
                            <option value="sp" {{ session()->get('locale') == 'sp' ? 'selected' : '' }}>Spanish
                            </option>
                        </select>
                    </li>

                    <li>
                        <select class="form-control select" onchange="ChangeCourse()">
                            @if (session('money'))
                                @foreach (session('money') as $item)
                                    <option value="0">{{ $item['name'] }}</option>
                                @endforeach
                            @else
                                <option value="0">TMT</option>
                            @endif
                            @foreach ($money_cours as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </li>

                    @guest
                        <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> Giriş</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i> Agza bolmak</a></li>
                    @endguest

                    @auth
                        <li>
                            <a href="{{ route('admin.index') }}"><i class="fa fa-user"></i>{{ Auth::user()->name }}</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post"> @csrf
                                <button type="submit"> Çykmak</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>

        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="{{ asset('img1/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="header-search">
                            <form class="header-search__form">

                                <input class="input" id="txtSearch" placeholder="Şu ýerden gözläň...">
                                <button class="search-btn">Göleg</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            {{-- Wishlist --}}
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-heart"></i>
                                    <span>Halananlar</span>
                                    <div class="qty"><span
                                            class="wish_qty">{{ count((array) session('wish')) }}</span></div>
                                </a>
                                <div class="cart-dropdown show_cart">
                                    <div class="cart-list1">
                                        @if (session('wish'))
                                            @foreach (session('wish') as $id => $details)
                                                <div class="product-widget">
                                                    <div class="product-img">
                                                        <img src="{{ asset('images/' . $details['image']) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <h3 class="product-name">{{ $details['name'] }}</h3>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="cart-btns">
                                        <a href="{{ route('cart') }}">Sebedi görmek</a>
                                    </div>
                                </div>
                            </div>
                            {{-- Cart --}}
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Sebet</span>
                                    <div class="qty"><span
                                            class="cart_qty">{{ count((array) session('cart')) }}</span></div>
                                </a>
                                <div class="cart-dropdown show_cart">
                                    <div class="cart-list">

                                        @php $total = 0 @endphp
                                        @foreach ((array) session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                        @endforeach

                                        @if (session('cart'))
                                            @foreach (session('cart') as $id => $details)
                                                <div class="product-widget">
                                                    <div class="product-img">
                                                        <img src="{{ asset('images/' . $details['image']) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <h3 class="product-name">{{ $details['name'] }}</h3>
                                                        <h4 class="product-price"><span
                                                                class="qty">{{ $details['quantity'] }}x</span>${{ $details['price'] }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="cart-summary">
                                        <h5>Jemi {{ $total }} TMT</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="{{ route('cart') }}">Sebedi görmek</a>
                                        <a href="{{ route('checkout') }}">Satyn almak <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav id="navigation">
        <div class="container">
            <div id="responsive-nav">
                <ul class="main-nav nav navbar-nav">
                    <li class=" @if (Request::routeIs('index')) active @endif"><a href="{{ route('index') }}">Baş
                            sahypa</a></li>
                    <li class=" @if (Request::routeIs('cart')) active @endif"><a
                            href="{{ route('cart') }}">Sebet</a></li>
                    <li class=" @if (Request::routeIs('store')) active @endif"><a
                            href="{{ route('store') }}">Harytlar</a></li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('skilet')
    @include('layouts.blank')
    @include('layouts.footer')
    <script src="{{ asset('js1/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('js1/jquery.min.js') }}"></script>
    <script src="{{ asset('js1/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js1/slick.min.js') }}"></script>
    <script src="{{ asset('js1/nouislider.min.js') }}"></script>
    <script src="{{ asset('js1/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js1/main.js') }}"></script>
    <script src="{{ asset('js1/jquery.cookie.js') }}"></script>
    @yield('layouts_product_scripts')
    @yield('cart_scripts')
    @yield('product_scripts')
    @yield('store_checkbox')
    <script>
        function ChangeCourse() {
            var id = $('.select').val()
            let data = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            $.get('{{ route('update_money') }}' + '/' + id, data, function(response) {
                console.log(response);
                location.reload()
            });

        }
    </script>
</body>

</html>
