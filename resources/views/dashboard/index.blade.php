<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <h2 class="ms-3 mt-4 font-weight-bolder">Selamat Datang, {{ auth()->user()->username }}</h2>
        @if($notification)
            <div class="alert alert-warning">
                {{ $notification }} perlu melakukan scanning terhadap ayam
            </div>
        @endif
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <!-- <i class="material-icons opacity-10">weekend</i> -->
                                <svg width="62" height="62" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M44.62 26.25C44.62 26.25 48.995 19 46.995 18C44.995 17 41.995 19 41.995 19C41.995 19 43.995 12 39.995 12C35.995 12 34.995 16 34.995 16C34.995 16 33.538 7.70395 27.995 9.99995C24.531 11.435 22.995 15 27.995 25" fill="#EA5A47"/>
                                    <path d="M21 35C21 35 25 24 36 24C47 24 51 35 51 35C66 63 36 64 36 64C36 64 5.99999 63 21 35Z" fill="white"/>
                                    <path d="M36 43C36 43 54 42 36 61C36 61 18 43 36 43Z" fill="#F1B31C"/>
                                    <path d="M44.46 26.25C44.46 26.25 48.835 19 46.835 18C44.835 17 41.835 19 41.835 19C41.835 19 43.835 12 39.835 12C35.835 12 34.835 16 34.835 16C34.835 16 33.378 7.70395 27.835 9.99995C24.371 11.435 22.835 15 27.835 25" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M27 41C28.1046 41 29 40.1046 29 39C29 37.8954 28.1046 37 27 37C25.8954 37 25 37.8954 25 39C25 40.1046 25.8954 41 27 41Z" fill="black"/>
                                    <path d="M45 41C46.1046 41 47 40.1046 47 39C47 37.8954 46.1046 37 45 37C43.8954 37 43 37.8954 43 39C43 40.1046 43.8954 41 45 41Z" fill="black"/>
                                    <path d="M36.02 43C36.02 43 54.02 42 36.02 61C36.02 61 18.02 43 36.02 43Z" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M21 35C21 35 25 24 36 24C47 24 51 35 51 35C66 63 36 64 36 64C36 64 5.99999 63 21 35Z" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mt-2 mb-4 text-capitalize">Data Ayam</p>
                                <h4 class="mb-2 me-2">{{ $totalStokAyam }} ekor</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-warning shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <!-- <i class="material-icons opacity-10">person</i> -->
                                <!-- <i class="bi bi-egg-fill"></i> -->
                                <svg width="50" height="60" viewBox="20 -10 20 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M38.57 5.67163C35.82 3.16496 32.8533 1.66663 30 1.66663C20.625 1.66663 10 17.685 10 33.3333C10 34.9583 10.1317 36.4983 10.3367 37.985C12.1017 50.8066 21.0383 58.3333 30 58.3333C40 58.3333 50 48.9816 50 33.3333C50 22.4483 44.8567 11.3983 38.57 5.67163Z" fill="#F7DECE"/>
                                    <path d="M38.57 5.67163C43.4167 11.5366 47.0833 20.7016 47.0833 29.76C47.0833 44.775 37.63 53.7483 28.1767 53.7483C20.6083 53.7483 13.0517 47.9833 10.335 37.9833C12.1017 50.8066 21.0383 58.3333 30 58.3333C40 58.3333 50 48.9816 50 33.3333C50 22.4483 44.8567 11.3983 38.57 5.67163Z" fill="#E0AA94"/>
                                </svg>

                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mt-2 mb-4 text-capitalize">Data Telur</p>
                                <h4 class="mb-2 me-2">{{ $totalStokTelur }} Kg</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-warning shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <!-- <i class="material-icons opacity-10">person</i> -->
                                <svg width="50" height="50" viewBox="0 0 50 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.25 4.16663H10.4167V45.8333H6.25V4.16663ZM39.5833 4.16663H12.5V45.8333H39.5833C41.8812 45.8333 43.75 43.9645 43.75 41.6666V8.33329C43.75 6.03538 41.8812 4.16663 39.5833 4.16663ZM37.5 25H18.75V20.8333H37.5V25ZM37.5 16.6666H18.75V12.5H37.5V16.6666Z" fill="#F24E1E"/>
                                </svg>

                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mt-2 mb-4 text-capitalize">Data Pakan</p>
                                <h4 class="mb-2 me-2">{{ $totalStokPakan }} Kg</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-warning shadow-primary border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Data Telur Harian</h6>
                            <!-- <p class="text-sm ">Last Campaign Performance</p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2  ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-warning shadow-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Data Telur Bulanan</h6>
                            <!-- <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p> -->
                        </div>
                    </div>
                </div>
            </div>
                
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
    <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");
        var dailyLabels = {!! json_encode($dailyEggData['labels']) !!}; // Ambil label harian dari controller
        var dailyData = {!! json_encode($dailyEggData['data']) !!}; // Ambil data harian dari controller


        new Chart(ctx, {
            type: "bar",
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: "Data Telur Harian (Kg)",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "rgba(255, 255, 255, .8)",
                    data: dailyData,
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");
        var monthLabels = {!! json_encode($monthlyEggData   ['labels']) !!}; // Ambil label harian dari controller
        var monthData = {!! json_encode($monthlyEggData ['data']) !!}; // Ambil data harian dari controller

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: monthLabels,
                datasets: [{
                    label: "Telur (Kg)",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: monthData,
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

    </script>
    @endpush
</x-layout>
