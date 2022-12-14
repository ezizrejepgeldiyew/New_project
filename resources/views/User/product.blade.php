@extends('layouts.app2')
@section('skilet')

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="{{ asset('images/' . $product->photo) }}" alt="">
                        </div>
                        @foreach (json_decode($product->photos) as $item)
                            <div class="product-preview">
                                <img src="{{ asset('images/' . $item) }}" alt="">
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{ asset('images/' . $product->photo) }}" alt="">
                        </div>
                        @foreach (json_decode($product->photos) as $item)
                            <div class="product-preview">
                                <img src="{{ asset('images/' . $item) }}" alt="">
                            </div>
                        @endforeach

                    </div>
                </div>

                @php
                    $all = 0;
                    foreach ($count as $item) {
                        $all = $all + $item;
                    }
                    $name = '';
                    if (session('money')) {
                        foreach (session('money') as $item) {
                            $name = $item['name'];
                            $price = $item['price'];
                        }
                    } else {
                        $name = 'TMT';
                        $price = 1;
                    }
                @endphp
                <div class="col-md-5">
                    <div class="product-details" data-id="{{ $product->id }}">
                        <h2 class="product-name">{{ $product->name }}</h2>
                        <div>
                            <div class="product-rating">
                                @for ($i = 0; $i < $product->rating; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                @for ($i = 0; $i < 5 - $product->rating; $i++)
                                    <i class="fa fa-star-o"></i>
                                @endfor
                            </div>
                            <a class="review-link" href="#">{{ $all }} Derejesi</a>
                        </div>
                        <div>
                            <h3 class="product-price"><span class="pro_price"
                                    value="{{ $product->price }}">{{ $product->price }}</span></h3>
                        </div>
                        <p>{{ $product->description }}</p>

                        <div class="product-options">
                            <label class="pro_qty">
                                Sany
                                <input type="number"
                                    @if (empty($cart['quantity'])) value="0" @else value="{{ $cart['quantity'] }}" @endif
                                    class="form-control quantity update-cart" />
                            </label>
                        </div>

                        <div class="add-to-cart">

                            <button class="add-to-cart-btn addtocart"><i class="fa fa-shopping-cart"></i> Sebede
                                go??</button>
                        </div>
                        <ul class="product-btns">
                            <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                        </ul>
                        <ul class="product-links">
                            <li>B??l??mi:</li>
                            <li>{{ $product->category->name }}</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-12">
                    <div id="product-tab">
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">D??????ndiri??</a></li>
                            <li><a data-toggle="tab" href="#tab2">Jikme-jiklikler</a></li>
                            <li><a data-toggle="tab" href="#tab3">Teswirler ({{ $all }})</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>

                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                            culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </div>
                            </div>

                            <div id="tab3" class="tab-pane fade in">
                                <div class="row">
                                    <!-- Rating -->
                                    <div class="col-md-3">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                <span>{{ $product->rating }}</span>
                                                <div class="rating-stars">
                                                    @for ($i = 0; $i < $product->rating; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                    @for ($i = 0; $i < 5 - $product->rating; $i++)
                                                        <i class="fa fa-star-o"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <ul class="rating">
                                                @for ($i = 5; $i > 0; $i--)
                                                    <li>
                                                        <div class="rating-stars">
                                                            @for ($j = 0; $j < $i; $j++)
                                                                <i class="fa fa-star"></i>
                                                            @endfor
                                                            @for ($j = 0; $j < 5 - $i; $j++)
                                                                <i class="fa fa-star-o"></i>
                                                            @endfor
                                                        </div>
                                                        @php
                                                            $t = 0;
                                                        @endphp
                                                        @foreach ($count as $key => $value)
                                                            @if ($i == $key)
                                                                @php
                                                                    $t = 1;
                                                                @endphp
                                                                <div class="rating-progress">
                                                                    <div style="width: {{ (100 * $value) / $all }}%;">
                                                                    </div>
                                                                </div>
                                                                <span class="sum">{{ $value }}</span>
                                                            @endif
                                                        @endforeach
                                                        @if ($t == 0)
                                                            <div class="rating-progress">
                                                                <div style="width: 0%;"></div>
                                                            </div>
                                                            <span class="sum">0</span>
                                                        @endif

                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Reviews -->
                                    <div class="col-md-6">
                                        <div id="reviews">
                                            @foreach ($review as $item)
                                                <ul class="reviews">
                                                    <li>
                                                        <div class="review-heading">
                                                            <h5 class="name">{{ $item->name }}</h5>
                                                            <p class="date">{{ $item->created_at }}</p>
                                                            <div class="review-rating">
                                                                @for ($i = 0; $i < $item->rating; $i++)
                                                                    <i class="fa fa-star"></i>
                                                                @endfor
                                                                @for ($i = 0; $i < 5 - $item->rating; $i++)
                                                                    <i class="fa fa-star-o empty"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <div class="review-body">
                                                            <p>{{ $item->discription }}</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @endforeach

                                            <ul class="reviews-pagination">

                                            </ul>
                                        </div>{{ $review->links() }}
                                    </div>

                                    <!-- Review Form -->
                                    <div class="col-md-3">
                                        <div id="review-form">
                                            <form class="review-form" action="{{ route('show.review', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                <input class="input" type="text" name="name" placeholder="Ady??yz">
                                                <input class="input" type="email" name="email"
                                                    placeholder="E-po??ta??yz">
                                                <textarea class="input" name="discription" placeholder="Teswiri??iz"></textarea>
                                                <div class="input-rating">
                                                    <span>Derej????iz: </span>
                                                    <div class="stars">
                                                        <input id="star5" name="rating" value="5"
                                                            type="radio"><label for="star5"></label>
                                                        <input id="star4" name="rating" value="4"
                                                            type="radio"><label for="star4"></label>
                                                        <input id="star3" name="rating" value="3"
                                                            type="radio"><label for="star3"></label>
                                                        <input id="star2" name="rating" value="2"
                                                            type="radio"><label for="star2"></label>
                                                        <input id="star1" name="rating" value="1"
                                                            type="radio"><label for="star1"></label>
                                                    </div>
                                                </div>
                                                <button class="primary-btn">Ugrat</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">

                                <div class="products-slick" data-nav="#slick-nav">
                                    @foreach ($products as $item)
                                        @if ($item->category_id == $product->category_id)
                                            @include('layouts.product')
                                        @endif
                                    @endforeach
                                </div>

                                <div id="slick-nav" class="products-slick-nav"></div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('product_scripts')
    <script>
        $(".update-cart").change(function() {
            var ele = $(this);
            let quantity = $(".pro_qty input").val();
            let id = ele.parents(".product-details").attr("data-id");
            let data = {
                _token: "{{ csrf_token() }}",
                id: id,
                quantity: quantity
            }
            $.post('{{ route('cartjquery.update') }}', data, function(response1) {

                if (response1 == false) {
                    let price = parseInt($(".pro_price").attr("value")) * quantity;
                    $(".pro_price").html(price);
                }

                let response = response1[0];
                let new_price = response.price * response.quantity;
                $(".pro_price").html(new_price);

                let response2 = response1[1];
                let sum1 = response2.length
                let all_text = ''
                $.each(response2, function($key, $element) {
                    all_text = all_text + GetHtmlBlade($element)
                });
                $('.cart-list').html(all_text)
                $(".cart_qty").html(sum1);
            });

        });

        $(".addtocart").click(function() {
            var ele = $(this);
            let data = {
                _token: "{{ csrf_token() }}",
                id: ele.parents(".product-details").attr("data-id"),
                quantity: $(".pro_qty input").val()
            }
            $.get('{{ route('cartjquery.store') }}', data, function(response) {
                let sum1 = response2.length
                let all_text = ''

                $.each(response, function($key, $element) {
                    all_text = all_text + GetHtmlBlade($element)
                });
                $('.cart-list').html(all_text)
                $(".cart_qty").html(sum1);
            });
        })

        function GetHtmlBlade($element) {
            let link = "{{ asset('images/') }}"
            text = ''
            text += '<div class="product-widget"> <div class="product-img"><img src=' + link
            text += '/' + $element.image + '></div> <div class="product-body" ><h3 class="product-name"> <a href="#">' +
                $element.name + '</a> </h3 ><h4 class="product-price"><span class="qty"> ' + $element.quantity +
                'x </span> $' + $element.price + '</h4></div></div>'
            return text
        }
    </script>
@endsection
@endsection
