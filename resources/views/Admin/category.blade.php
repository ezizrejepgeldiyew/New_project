@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Category Table
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#gos">
                                    Goş
                                </button>
                            </h5>

                            @if (count($category) > 0)
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $item)
                                            <tr>
                                                <th scope="row">{{ $item->id }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('category.destroy', $item->id) }}"
                                                        method="POST">
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
                    <h5 class="modal-title">Category create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('category.store') }}" method="post"> @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control">
                            </div>
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

    @foreach ($category as $item)
        {{-- Category Update Modal --}}
        <div class="modal fade" id="uytget{{ $item->id }}" tabindex="-1" data-bs-backdrop="false" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Category update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('category.update', $item->id) }}" method="post">
                            @csrf @method('PUT')
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ $item->name }}" class="form-control">
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
    @endforeach
@endsection
