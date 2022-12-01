@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Harytlaryň statistikasy</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg">
                    <div class="row">
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Harytlar</h5>
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Ady</th>
                                                <th scope="col">Bahasy</th>
                                                <th scope="col">Zakazlarynyň sany</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pro_downloads as $item)
                                                <tr>
                                                    <th scope="row">{{ $item->id }}</th>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->product->price }} </td>
                                                    <td>{{ $item->download }}</td>
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
