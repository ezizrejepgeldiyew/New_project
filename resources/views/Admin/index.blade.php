@extends('layouts.app1')
@section('skilet')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Bas sahypa</h1>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg">
                    <div class="row">

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">


                                <div class="card-body">
                                    <h5 class="card-title">Zakazlar</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $zakazlar }}</h6>
                                            <span class="text-success small pt-1 fw-bold">{{ $ugradylmadyk }}</span> <span
                                                class="text-muted small pt-2 ps-1">ugradylmadyk</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Jemi harytlar</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>$3,264</h6>
                                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Userler</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $user }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Line Chart</h5>
                                    <div id="lineChart"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#lineChart"), {
                series: [{
                    name: "Desktops",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3',
                            'transparent'
                        ], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                }
            }).render();
        });
    </script>
@endsection
