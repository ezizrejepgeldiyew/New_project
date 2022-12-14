@extends('layouts.app2')
@section('skilet')
    <div class="section">
        <div class="container">
            <div class="row">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:40%">Suraty</th>
                            <th style="width:10%">Ady</th>
                            <th style="width:10%">Bahasy</th>
                            <th style="width:8%">Sany</th>
                            <th style="width:22%" class="text-center">Jemi bahasy</th>
                            <th style="width:10%">Pozmak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; $name = "";
                            if (session('money'))
                            {
                                foreach (session('money') as $item)
                                {
                                    $name = $item['name'];
                                    $price = $item['price'];
                                }
                            }
                            else {
                                $name = "TMT";
                                $price = 1;
                            }

                         @endphp
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}" id="card{{ $id }}">
                                    <td data-th="Suraty">
                                        <div class="row">
                                            <div class="col-sm-3 hidden-xs"><a href="{{ route('show', $id) }}"><img
                                                        src="{{ asset('images/' . $details['image']) }}" width="100"
                                                        height="100" class="img-responsive" /></a></div>
                                        </div>
                                    </td>
                                    <td data-th="Ady">
                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    </td>
                                    <td data-th="Bahasy">{{ $details['price'] / $price }} {{ $name }}</td>
                                    <td data-th="Sany">
                                        <input type="number" value="{{ $details['quantity'] }}"
                                            class="form-control quantity update-cart" />
                                    </td>
                                    <td data-th="Jemi bahasy" class="text-center">
                                        <span
                                            class="prod{{ $id }} product">{{ ($details['price'] * $details['quantity'])/ $price }}
                                        </span>{{ $name }}
                                    </td>
                                    <td class="actions" data-th="">
                                        <button class="btn btn-danger btn-sm remove-from-cart"><i
                                                class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right">
                                <h3><strong>Jemi <span class="pro_total">{{ $total / $price }} {{ $name }}</span></strong></h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">
                                <a href="{{ route('checkout') }}" class="btn btn-success">
                                    Satyn almak</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@section('cart_scripts')
    <script>
        $(".update-cart").change(function() {
            var ele = $(this);
            let data = {
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val(),
                _token: "{{ csrf_token() }}"
            }
            $.post('{{ route('cartjquery.update') }}', data, function(response1) {
                let response = response1[0];
                let iid = ".prod" + response.id;
                $(iid).html(response.price * response.quantity);
                let elements = document.getElementsByClassName("product");
                let sum = 0;
                for (let elemnt of elements) {
                    sum += parseInt(elemnt.innerText);
                }
                $(".pro_total").html(sum);


                let response2 = response1[1];
                let sum1 = 0
                let link = "{{ asset('images/') }}"
                let all_text = ''
                $.each(response2, function($key, $element) {
                    sum1++;
                    text = ''
                    text += '<div class="product-widget"> <div class="product-img"><img src=' + link
                    text += '/' + $element.image +
                        ' alt="" ></div> <div class="product-body" ><h3 class="product-name"> <a href="#">' +
                        $element.name + '</a> </h3 ><h4 class="product-price"><span class="qty"> ' +
                        $element.quantity + 'x </span> $' + $element.price + '</h4></div></div>'
                    all_text = text + all_text
                });
                $('.cart-list').html(all_text)
                $(".cart_qty").html(sum1);
            });
        });

        $(".remove-from-cart").click(function() {
            var ele = $(this);

            let data = {
                _token: "{{ csrf_token() }}",
                id: ele.parents("tr").attr("data-id")
            }
            $.get('{{ route('cartjquery.remove') }}', data, function(response) {
                let new_id = "card" + data.id
                let element = document.getElementById(new_id)
                element.remove();
                let sum = 0
                let link = "{{ asset('images/') }}"
                let all_text = ''
                let total = 0

                $.each(response, function($key, $element) {
                    total = total + ($element.quantity * $element.price)
                    sum++;
                    text = ''
                    text += '<div class="product-widget"> <div class="product-img"><img src=' + link
                    text += '/' + $element.image +
                        ' alt="" ></div> <div class="product-body" ><h3 class="product-name"> <a href="#">' +
                        $element.name + '</a> </h3 ><h4 class="product-price"><span class="qty"> ' +
                        $element.quantity + 'x </span> $' + $element.price + '</h4></div></div>'
                    all_text = text + all_text
                });
                $('.cart-list').html(all_text)
                $(".cart_qty").html(sum);
                $(".pro_total").html(total);
            });
        });
    </script>
@endsection
@endsection
