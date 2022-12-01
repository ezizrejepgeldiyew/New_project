@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Arzanlaşykdaky harytlar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminindex') }}">Home</a></li>
                    <li class="breadcrumb-item active">Arzanlaşykdaky harytlar</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg">
                    <div class="row">

                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body"><br>

                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th scope="col"><input type="checkbox" class="highlight"
                                                        name="select_all" id="check_all" onchange="checkAll(this)">
                                                    Hemmesi
                                                </th>
                                                <th scope="col">Ady</th>
                                                <th scope="col">Suraty</th>
                                                <th scope="col">Bahasy</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($discount_product as $item)
                                                <tr>
                                                    <th scope="row"><input type="checkbox" class="highlight"
                                                            name="sport" id="check{{ $item->id }}"
                                                            value="{{ $item->id }}"></th>
                                                    <td> {{ $item->name }}</td>
                                                    <td><img src="{{ asset('images/' . $item->photo) }}" height="100px"
                                                            alt=""></td>
                                                    <td>{{ $item->price }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <form>
                                        <div class="col-6">
                                            <div class="row mb-3">
                                                <label for="inputText" class="col-sm-2 col-form-label">Goterimi
                                                    giriz</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="discount">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputText" class="col-sm-2 col-form-label">Wagty
                                                    giriz</label>
                                                <div class="col-sm-10">
                                                    <input type="datetime-local" class="form-control" id="datetime">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="button">Ugrat</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


@section('checkbox_jquery')
    <script src="{{ asset('js/date_time_moment.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#button").click(function() {
                var product_id = [];
                $.each($("input[name='sport']:checked"), function() {
                    product_id.push($(this).val());
                });
                let until_time = $("#datetime").val();
                let discount_price = $('#discount').val();
                let data = {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                    date: moment(until_time).format("YYYY-MM-DD HH:mm:ss"),
                    discount_price: discount_price
                }
                console.log(data);
                $.post('{{ route('discount_product.api.store') }}', data, function(response) {
                    console.log(response);
                });
            });
        });

        function checkAll(ele) {
            var checkboxes = document.getElementsByTagName('input');
            if (ele.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox' && !(checkboxes[i].disabled)) {
                        checkboxes[i].checked = true;
                    }

                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = false;
                    }
                }
            }
        }
    </script>
@endsection
@endsection
