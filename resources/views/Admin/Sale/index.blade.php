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

                                    <table class="table table-borderless datatable">
                                        <thead> <a href="{{ route('discount_product.create') }}"
                                                class="btn btn-outline-success">Goş</a>
                                            <tr>
                                                <th scope="col">Id
                                                </th>
                                                <th scope="col">Ady</th>
                                                <th scope="col">Öňki bahasy</th>
                                                <th scope="col">Häzirki bahasy</th>
                                                <th scope="col">Göterimi</th>
                                                <th scope="col">Haçana çenli</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($discount_product as $item)
                                                <tr>
                                                    <th scope="row">{{ $item->id }}</th>
                                                    <td> {{ $item->product->name}}</td>
                                                    <td>{{ $item->product->price }}</td>
                                                    <td>{{ ($item->product->price / 100) * ($item->discount_price) }}</td>
                                                    <td>{{ $item->discount_price }}</td>
                                                    <td>{{ $item->date }}</td>
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
@endsection
