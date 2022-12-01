@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product Table
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#product_gos">
                                    Goş
                                </button>
                            </h5>
                            @if (count($product) > 0)
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">OurBrand</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $item)
                                            <tr>
                                                <th scope="row">{{ $item->id }}</th>
                                                <td><img src="{{ asset('images/' . $item->photo) }}" height="100px"
                                                        alt=""></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->ourbrand->name }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <form action="{{ route('product.destroy', $item->id) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                    <button type="button" class="btn btn-outline-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#product_update{{ $item->id }}">
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
                    {{-- Product Create Modal --}}
                    <div class="modal fade" id="product_gos" tabindex="-1" data-bs-backdrop="false" aria-hidden="true"
                        style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Product create</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('product.store') }}" method="post"
                                        enctype="multipart/form-data"> @csrf

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                                            <input type="file" class="form-control" name="photo"
                                                onchange="previewFile(this)">
                                            <img id="previewImg" style="max-width: 130px; margin-top: 20px;">
                                        </div>


                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Images</label>
                                            <input type="file" class="form-control" name="photos[]" multiple>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Category</label>
                                            <select class="form-select" name="category_id"
                                                aria-label="Default select example">
                                                <option selected="">Category</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">OurBrand</label>
                                            <select class="form-select" name="ourbrand_id"
                                                aria-label="Default select example">
                                                <option selected="">Ourbrands</option>
                                                @foreach ($ourbrand as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="price" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="description" style="height: 100px"></textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
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
    {{-- Product Update Modal --}}
    @foreach ($product as $item)
        <div class="modal fade" id="product_update{{ $item->id }}" tabindex="-1" data-bs-backdrop="false"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Product update </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product.update', $item->id) }}" method="POST"
                            enctype="multipart/form-data"> @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                                <input type="file" class="form-control" name="photo" onchange="previewFile(this)">
                                <img id="previewImg" style="max-width: 130px; margin-top: 20px;">
                            </div>


                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Images</label>
                                <input type="file" class="form-control" name="photos[]" multiple>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Category</label>
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                    <option selected="" value="{{ $item->category_id }}">{{ $item->category->name }}
                                    </option>
                                    @foreach ($category as $item1)
                                        <option value="{{ $item1->id }}">{{ $item1->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">OurBrand</label>
                                <select class="form-select" name="ourbrand_id" aria-label="Default select example">
                                    <option selected="" value="{{ $item->ourbrand_id }}">{{ $item->ourbrand->name }}
                                    </option>
                                    @foreach ($ourbrand as $item1)
                                        <option value="{{ $item1->id }}">{{ $item1->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $item->name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="number" name="price" class="form-control"
                                        value="{{ $item->price }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" style="height: 100px">{{ $item->description }}</textarea>
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
