@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Our Brand Table
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#gos">
                                    Goş
                                </button>
                            </h5>

                            @if (count($ourbrands) > 0)
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ourbrands as $item)
                                            <tr>
                                                <th scope="row">{{ $item->id }}</th>
                                                <td><img src="{{ asset('images/' . $item->photo) }}" height="100px"
                                                        alt=""></td>
                                                <td class="name">{{ $item->name }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <form action="{{ route('ourbrand.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                    <button type="button" class="btn btn-outline-info"
                                                        data-bs-toggle="modal" data-bs-target="#update{{ $item->id }}">
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
    {{-- ourbrandss Create Modal --}}
    <div class="modal fade" id="gos" tabindex="-1" data-bs-backdrop="false" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Our brand create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ourbrand.store') }}" method="post" enctype="multipart/form-data"> @csrf
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="photo" onchange="previewFile(this)">
                            <img id="previewImg" alt="profile image" style="max-width: 130px; margin-top: 20px;">
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @foreach ($ourbrands as $item)
        {{-- ourbrandss Update Modal --}}
        <div class="modal fade" id="update{{ $item->id }}" tabindex="-1" data-bs-backdrop="false" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Our brand update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('ourbrand.update', $item->id) }}" method="post"
                            enctype="multipart/form-data"> @csrf
                            @method('PUT')
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="photo" onchange="previewFile(this)">
                                <img id="previewImg" alt="profile image" style="max-width: 130px; margin-top: 20px;"
                                    src="{{ asset('images/' . $item->photo) }}">
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ $item->name }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

@endsection
