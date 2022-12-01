@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kurslar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminindex') }}">Home</a></li>
                    <li class="breadcrumb-item active">Kurslar</li>
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
                                        <thead> <button type="button" class="btn btn-outline-success"
                                                data-bs-toggle="modal" data-bs-target="#gos">
                                                Goş
                                            </button>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Ady</th>
                                                <th scope="col">Gysgaltmasy</th>
                                                <th scope="col">Bahasy</th>
                                                <th scope="col">Sazlamalar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($money_cours as $item)
                                                <tr>
                                                    <th scope="row">{{ $item->id }}</th>
                                                    <td>{{ $item->fullname }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>
                                                        <form action="{{ route('money_cours.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </form>
                                                        <button type="button" class="btn btn-outline-info"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#uytget{{ $item->id }}">
                                                            <i class="ri-settings-5-line"></i>
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

    {{-- Money_Cours Create Modal --}}
    <div class="modal fade" id="gos" tabindex="-1" data-bs-backdrop="false" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kurs goş</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('money_cours.store') }}" method="post"> @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Ady</label>
                            <div class="col">
                                <input type="text" name="fullname" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Gysgaltmasy</label>
                            <div class="col">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Bahasy</label>
                            <div class="col">
                                <input type="number" name="price" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ýatyr</button>
                        <button type="submit" class="btn btn-primary">Goş</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @foreach ($money_cours as $item)
        {{-- Money Cours Update Modal --}}
        <div class="modal fade" id="uytget{{ $item->id }}" tabindex="-1" data-bs-backdrop="false" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kursy üýtget</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('money_cours.update', $item->id) }}" method="post">
                            @csrf @method('PUT')
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Ady</label>
                                <div class="col">
                                    <input type="text" name="fullname" class="form-control"
                                        value="{{ $item->fullname }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Gysgaltmasy</label>
                                <div class="col">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $item->name }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Bahasy</label>
                                <div class="col">
                                    <input type="number" name="price" class="form-control"
                                        value="{{ $item->price }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ýatyr</button>
                                <button type="submit" class="btn btn-primary">Üýtget</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
