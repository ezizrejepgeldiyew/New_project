@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ugradylmadyk harytlar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminindex') }}">Home</a></li>
                    <li class="breadcrumb-item">Zakazlar</li>
                    <li class="breadcrumb-item active">Ugradylmadyk</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg">
                    <div class="row">
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <br>
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Show</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order as $item)
                                                <tr>
                                                    <th scope="row"><a href="#"> {{ $loop->index + 1 }}</a></th>
                                                    <td> {{ $item['user_name'] }}</td>
                                                    <td><a href="tel:{{ $item['user_phone'] }}"
                                                            class="text-primary">{{ $item['user_phone'] }}</a>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input"
                                                                onclick="ChangeStatus({{ $item['product_id'] }})"
                                                                type="checkbox"
                                                                @if ($item['status']) checked @endif
                                                                id="flexSwitchCheckChecked">
                                                        </div>
                                                    </td>
                                                    <td><button type="button" class="btn btn-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#verticalycentered{{ $loop->index + 1 }}">
                                                            <i class="bi bi-collection"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @foreach ($order as $item)
        <div class="modal fade" id="verticalycentered{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Products</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless ">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Sum</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($item['products'] as $key => $value)
                                    <tr>
                                        <th scope="row"><a href="#">{{ $loop->index + 1 }}</a>
                                        </th>
                                        <td><img class="lazy" src="{{ asset('images/' . $value->photo) }}" height="50px"
                                                alt="">
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            {{ $item['quantity'][$key] }}
                                        </td>
                                        <td>{{ $value->price }}</td>
                                        <td> {{ $item['quantity'][$key] * $value->price }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        function ChangeStatus(id) {
            link = window.location + "/changestatus/" + id
            $.ajax(link, "get", function(response) {
                console.log(response)
            });
        }
    </script>
@endsection
