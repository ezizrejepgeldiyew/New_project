@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Ulgamdaky ulanyjylar</h1>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg">
                    <div class="row">

                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Userler</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Ady</th>
                                                <th scope="col">Tel nomeri</th>
                                                <th scope="col">Iň soňky gezek</th>
                                                <th scope="col">Statistika</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($online_users as $item)
                                                <tr>
                                                    <th scope="row">{{ $item->id }}</th>
                                                    <td>{{ $item->name }}</td>
                                                    <td><a href="tel:{{ $item->phone_number }}">{{ $item->phone_number }}</a></td>
                                                    <td>{{ Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</td>
                                                    <td>
                                                        @if (Cache::has('user-is-online-' . $item->id))
                                                            <span class="badge bg-success">Online</span>
                                                        @else
                                                            <span class="badge bg-secondary">Offline</span>
                                                        @endif
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
@endsection
