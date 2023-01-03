@extends('layouts.app2')
@section('skilet')

    <div class="section">
        <div class="container">
            <div class="row">
                <div id="aside" class="col-md-3">
                    <div class="aside">
                        <h3 class="aside-title">Bölümler</h3>
                        <div class="checkbox-filter">
                            @foreach ($category as $key => $value)
                                <div class="input-checkbox">
                                    <input type="checkbox" class="category_checkbox" value="{{ $value->id }}"
                                        id="category-{{ $key }}">
                                    <label for="category-{{ $key }}">
                                        <span></span>
                                        {{ $value->name }}
                                        <small>(120)</small>
                                    </label>
                                </div>
                            @endforeach


                        </div>
                    </div>

                    <div class="aside">
                        <h3 class="aside-title">Bahasy</h3>
                        <div class="price-filter">
                            <input type="number" id="price-min" class="form-control input-number price-max" value="0">
                            <span>-</span>
                            <input type="number" id="price-max" class="form-control input-number price-max" value="100000">
                        </div>
                    </div>


                    <div class="aside">
                        <h3 class="aside-title">Brand Markalar</h3>
                        <div class="checkbox-filter">
                            @foreach ($ourbrand as $key => $value)
                                <div class="input-checkbox">
                                    <input type="checkbox" value="{{ $value->id }}" id="brand-{{ $key }}">
                                    <label for="brand-{{ $key }}">
                                        <span></span>
                                        {{ $value->name }}
                                        <small>(578)</small>
                                    </label>
                                </div>
                            @endforeach


                        </div>
                    </div>

                    <div class="aside">
                        <h3 class="aside-title">Iň köp satylanlar</h3>
                        @foreach ($topSelling as $item)
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{ asset('images/' . $item->product->photo) }}" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{ $item->product->category->name }}</p>
                                    <h3 class="product-name"><a
                                            href="{{ route('show', $item->product->id) }}">{{ $item->product->name }}</a>
                                    </h3>
                                    <h4 class="product-price">{{ $item->product->price }}</h4>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div id="store" class="col-md-9">
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Tertiple:
                                <select class="input-select" id="sortBy">
                                    @if (!empty(Cookie::get('sortName')))
                                        <option value="{{ (int)Cookie::get('sortBy') }}">{{ Cookie::get('sortName') }}</option>
                                    @endif
                                    <option value="3">Saýlanmadyk</option>
                                    <option value="1">Arzandan gymmada</option>
                                    <option value="2">Gymmatdan arzana</option>
                                </select>
                            </label>
                        </div>

                    </div>
                    <div class="row hii">
                        @foreach ($product as $item)
                            <div class="col-md-4 col-xs-6">
                                @include('layouts.product')
                            </div>
                        @endforeach
                    </div>
                    <div class="show-more-btn-cont">
                    <button id="load-more">Load More&nbsp;&nbsp;</button>
                </div>
                </div>
            </div>
        </div>
    </div>
@section('store_checkbox')
    <script>
        $(document).ready(function() {
            const rangeInput = document.querySelectorAll(".price-filter input");

            function request() {
                let search = $("#txtSearch").val();
                var arr_id = [];
                $(":checkbox:checked").each(function(i) {
                    arr_id[i] = $(this).val();
                });
                if (arr_id.length == 0) {
                    arr_id = null
                }
                rangeInput.forEach(input => {
                    input.addEventListener("input", () => {
                        let minVal = parseInt(rangeInput[0].value),
                            maxVal = parseInt(rangeInput[1].value)
                    })
                })
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value)
                var sortName = $('#sortBy option:selected').text();
                var sortBy = $('#sortBy option:selected').val();
                let data = {
                    _token: "{{ csrf_token() }}",
                    search: search,
                    arr_id: arr_id,
                    minVal: minVal,
                    maxVal: maxVal,
                    sortName: sortName,
                    sortBy: sortBy
                }
                return data
            }

            let load = 6;
            $('#load-more').click(function() {
                load = load + 3
                let data = request()
                data.load = load
                let all_txt = '';
                $.post('{{ route('store.loadMore') }}', data, function(response) {
                    $.each(response, function($key, $item) {
                        all_txt = all_txt + GetHtmlBlade($item)
                    });
                    if (load == 9) {
                        $(".hii").html(all_txt);
                    } else {
                        $(".hii").append(all_txt);
                    }
                })
            })

            $('#txtSearch').on('keyup', function() {
                let data = request()
                data.load = load
                $.post('{{ route('store.loadMore') }}', data, function(response) {
                    let all_txt = '';
                    $.each(response, function($key, $item) {
                        all_txt = all_txt + GetHtmlBlade($item)
                    })
                    $(".hii").html(all_txt);
                })
            });

            $('input[type="checkbox"]').click(function() {
                let data = request()
                data.load = load
                console.log(data);
                $.post('{{ route('store.loadMore') }}', data, function(response) { console.log(response);
                    let all_txt = '';
                    $.each(response, function($key, $item) {
                        all_txt = all_txt + GetHtmlBlade($item)
                    })
                    $(".hii").html(all_txt);
                })
            });

            $('#sortBy').change(function(){
                let data = request()
                data.load = load
                $.post('{{ route('store.loadMore') }}', data, function(response) {
                    let all_txt = '';
                    $.each(response, function($key, $item) {
                        all_txt = all_txt + GetHtmlBlade($item)
                    })
                    $(".hii").html(all_txt);
                })
            })
        });


        function request() {
            let search = $("#txtSearch").val();
            var arr_id = [];
            $(":checkbox:checked").each(function(i) {
                arr_id[i] = $(this).val();
            });
            if (arr_id.length == 0) {
                arr_id = null
            }
            let loadMore = 6
            var sortName = $('#sortBy option:selected').text();
            var sortBy = $('#sortBy option:selected').val();
            let data = {
                _token: "{{ csrf_token() }}",
                search: search,
                arr_id: arr_id,
                minVal: minVal,
                maxVal: maxVal,
                sortName: sortName,
                sortBy: sortBy
            }
            return data
        }

        // const rangeInput = document.querySelectorAll(".price-filter input");
        // rangeInput.forEach(input => {
        //     input.addEventListener("input", () => {
        //         let minVal = parseInt(rangeInput[0].value),
        //             maxVal = parseInt(rangeInput[1].value)
        //     })
        //     let minVal = parseInt(rangeInput[0].value),
        //         maxVal = parseInt(rangeInput[1].value)
        //     let data = request()
        //     console.log(data);
        //     data.minVal = minVal
        //     data.maxVal = maxVal
        //     console.log(data);
        //     $.post('{{ route('store.loadMore') }}', data, function(response) {
        //         let all_txt = ''
        //         $.each(response, function($key, $item) {
        //             all_txt = all_txt + GetHtmlBlade($item)
        //         });
        //         $(".hii").html(all_txt);
        //     });
        // });


        function GetHtmlBlade($item) {
            url = "{{ url('product1') }}/" + $item.id
            let link = "{{ asset('images/') }}"

            all_txt = ''
            let text = ''
            text +=
                '<div class="col-md-4 col-xs-6"><div class="product wishlist"><div class="product-img"><img src=' +
                link
            text += '/' + $item.photo +
                ' alt=""> <div class="product-label">'
            text +=
                '</div></div><div class="product-body">'
            text += '<p class="product-category">'+ $item.category.name +'</p>'
            text += '<h3 class="product-name"><a href="#">' + $item
                .name + '</a></h3>'
            text += '<h4 class="product-price">' + $item.price +
                ' </h4> <div class="product-btns"> <button class="fa fa-heart-o btn_wish" value="' +
                $item.id +
                '" id="result" type="submit"></i><span class="tooltipp">add to wishlist</span></button>'
            text +=
                '<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button> <button class="quick-view"><a href="' +
                url +
                '"><i class="fa fa-eye"></i></a><span class="tooltipp">quick view</span></button>'
            text += '</div></div> <div class="add-to-cart" id="cart' +
                $item.id + '" data-id="' + $item.id +
                '"><button class="add-to-cart-btn addtocart" onclick="myCartFunction(' + $item.id +
                ')"><i class="fa fa-shopping-cart"></i>add to cart</button></div></div></div>'
            all_txt = all_txt + text
            return all_txt
        }
    </script>
@endsection
@endsection
