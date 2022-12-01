@extends('layouts.app1')
@section('skilet')
    <style>
        /* padding-bottom and top for image */
        .mfp-no-margins img.mfp-img {
            padding: 0;
        }

        /* position of shadow behind the image */
        .mfp-no-margins .mfp-figure:after {
            top: 0;
            bottom: 0;
        }

        /* padding for main container */
        .mfp-no-margins .mfp-container {
            padding: 0;
        }
    </style>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Bildrişler</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminindex') }}">Baş sahypa</a></li>
                    <li class="breadcrumb-item active">Bildirişler</li>
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
                                                <th scope="col">Link</th>
                                                <th scope="col">Surat</th>
                                                <th scope="col">Beýany</th>
                                                <th scope="col">Wagty</th>
                                                <th scope="col">Sazlamalar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notices as $item)
                                                <tr>
                                                    <th scope="row">{{ $item->id }}</th>
                                                    <td>{{ $item->title }}</td>
                                                    <td><a href="http://{{ $item->link }}"
                                                            target="_blank">{{ $item->link }}</a></td>
                                                    <td>

                                                        <a class="image-popup-vertical-fit"
                                                            href="{{ asset('images/' . $item->photo) }}">
                                                            <img src="{{ asset('images/' . $item->photo) }}" height="100px"
                                                                alt="">
                                                        </a>
                                                    </td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->date }}</td>
                                                    <td>
                                                        <form action="{{ route('notices.destroy', $item->id) }}"
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

    {{-- Notices Create Modal --}}
    <div class="modal fade" id="gos" tabindex="-1" data-bs-backdrop="false" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bildiriş goş</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('notices.store') }}" method="post" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Ady</label>
                            <div class="col">
                                <input type="text" name="title" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Link</label>
                            <div class="col">
                                <input type="text" name="link" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Suraty</label>
                            <div class="col">
                                <input type="file" name="photo" class="form-control" onchange="previewFile(this)">
                                <img id="previewImg" style="max-width: 130px; margin-top: 20px">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Beýany</label>
                            <div class="col">
                                <input type="text" name="description" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Wagty</label>
                            <div class="col">
                                <input type="date" name="date" class="form-control">
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

    @foreach ($notices as $item)
        {{-- Notices Update Modal --}}
        <div class="modal fade" id="uytget{{ $item->id }}" tabindex="-1" data-bs-backdrop="false"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bildirişi üýtget</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('notices.update', $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Ady</label>
                                    <div class="col">
                                        <input type="text" name="title" value="{{ $item->title }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Link</label>
                                    <div class="col">
                                        <input type="text" name="link" value="{{ $item->link }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Suraty</label>
                                    <div class="col">
                                        <input type="file" name="photo" class="form-control" onchange="previewFile(this)">
                                <img id="previewImg" style="max-width: 130px; margin-top: 20px">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Beýany</label>
                                    <div class="col">
                                        <input type="text" name="description" value="{{ $item->description }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Wagty</label>
                                    <div class="col">
                                        <input type="date" name="date" value="{{ $item->date }}"
                                            class="form-control">
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

@section('show_photo')
    <script>
        $(document).ready(function() {

            $('.image-popup-vertical-fit').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-img-mobile',
                image: {
                    verticalFit: true
                }

            });

            $('.image-popup-fit-width').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                image: {
                    verticalFit: false
                }
            });

            $('.image-popup-no-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300 // don't foget to change the duration also in CSS
                }
            });

        });
    </script>
@endsection
