@extends('layouts.app2')
@section('skilet')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="{{ asset('img1/shop01.png') }}" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Noutbuk <br> ýygyndysy</h3>
                            <a href="#" class="cta-btn">Häzir dükan <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="{{ asset('img1/shop03.png') }}" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Aksesuarlar<br>ýygyndysy</h3>
                            <a href="#" class="cta-btn">Häzir dükan <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="shop" style="height: 240px">
                        <div class="shop-img">
                            <img src="{{ asset('img1/shop02.png') }}" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Kamera<br>ýygyndysy</h3>
                            <a href="#" class="cta-btn">Häzir dükan <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Täze harytlar</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach ($category as $key => $item)
                                    <li class="@if ($key==0) active @endif">
                                        <a data-toggle="tab" href="#tab{{ $key }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            @foreach ($category as $key => $value)
                                <div id="tab{{ $key }}" class="tab-pane @if ($key==0) active @endif">
                                    <div class="products-slick" data-nav="#slick-nav-{{ $key }}">
                                        @foreach ($product as $item)
                                            @if((date('d',(strtotime(now())-strtotime($item->created_at))) <=7) && ($item->category_id == $value->id))
                                                @include('layouts.product')
                                            @endif
                                        @endforeach
                                    </div>
                                    <div id="slick-nav-{{ $key }}" class="products-slick-nav"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($notices as $item)
    <div id="hot-deal" class="section" background-image= {{ asset('../img1/hotdeal.png') }}>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Gün</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Sagat</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Minut</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Sekunt</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">Bu hepde gyzgyn şertnama</h2>
                        <p>50% -e çenli täze kolleksiýa</p>
                        <a class="primary-btn cta-btn" href="#">Häzir dükan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Iň köp satylanlar</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach ($category as $key => $item)
                                    <li class="@if ($key==0) active @endif">
                                        <a data-toggle="tab" href="#taba{{ $key }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            @foreach ($category as $key => $value)
                                <div id="taba{{ $key }}" class="tab-pane fade in @if ($key==0) active @endif">
                                    <div class="products-slick" data-nav="#slick-nav-a{{ $key }}">
                                        @foreach ($product as $item)
                                            @if ($item->category_id == $value->id)
                                                @include('layouts.product')
                                            @endif
                                        @endforeach
                                    </div>
                                    <div id="slick-nav-a{{ $key }}" class="products-slick-nav"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
