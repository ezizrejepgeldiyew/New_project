@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Biz barada
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#gos">
                                    Goş
                                </button>
                            </h5>

                            @if (count($aboutUs) > 0)
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Tel nomer</th>
                                            <th scope="col">Ýerleşýän ýeri</th>
                                            <th scope="col">Maglumat</th>
                                            <th scope="col">Goşulan wagty</th>
                                            <th scope="col">Ulgamlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($aboutUs as $item)
                                            <tr>
                                                <th scope="row">{{ $item->id }}</th>
                                                <td>{{ $item->email }}</td>
                                                <td><a href="tel:{{ $item->phone }}"
                                                        target="_blank()">{{ $item->phone }}</a></td>
                                                <td><a href="https://maps.google.com/maps?q={{ $item->map }}"
                                                        target="_blank()">{{ $item->map }}</a></td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <form action="{{ route('aboutUs.destroy', $item->id) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                    <button type="button" class="btn btn-outline-info"
                                                        data-bs-toggle="modal" data-bs-target="#uytget{{ $item->id }}">
                                                        <i class="ri-settings-5-line"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    {{-- Category Create Modal --}}
    <div class="modal fade" id="gos" tabindex="-1" data-bs-backdrop="false" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Biz barada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('aboutUs.store') }}" method="post"> @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Tel</label>
                            <div class="col-sm-10">
                                <input type="number" name="phone" class="form-control">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="map" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Maglumat</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ýatyr</button>
                            <button type="submit" class="btn btn-primary">Goş</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    {{-- Category Update Modal --}}
    @foreach ($aboutUs as $item)
        <div class="modal fade" id="uytget{{ $item->id }}" tabindex="-1" data-bs-backdrop="false" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Category update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('aboutUs.update', $item->id) }}" method="post">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" value="{{ $item->email }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Tel</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="phone" class="form-control" value="{{ $item->phone }}" required>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="map" class="form-control" value="{{ $item->map }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Maglumat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="description" class="form-control" value="{{ $item->description }}">
                                    </div>
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
