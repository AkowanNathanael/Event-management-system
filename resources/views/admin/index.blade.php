<!doctype html>

<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="dist/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title> @yield('title')</title>
    <meta name="description" content="" />
    {{-- css --}}
    <x-css />
    {{-- css end --}}

</head>

<body>
    <!-- Layout wrapper -->
    <div id="top" class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- sidebar Menu -->
            <x-sidebar />
            <!-- / sidebarMenu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <x-navbar />
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">


                        @if (auth()->user()->isadmin == 1)
                            <div class="row">
                                <div id="csa">
                                </div>
                            </div>
                            <div class="row">
                                <!-- Order Statistics -->
                                <div class="col-md-6 col-lg-12 col-xl-12 order-0 mb-6">
                                    <div class="card h-100">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="card-title mb-0">
                                                <h5 class="mb-1 me-2"> @auth
                                                        auther
                                                        @endauth || @guest
                                                        Welcome guest
                                                    @endguest </h5>

                                            </div>

                                        </div>
                                        <div class="card-body row">
                                            <div class="card  col-lg-3 m-1 shadow shadow-primary">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-4">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('dist/img/icons/unicons/wallet-info.png') }}"
                                                                alt="wallet info" class="rounded">
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">No. of Users</p>
                                                    <h4 class="card-title mb-3">{{ $users }}</h4>
                                                    {{-- <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                                </div>
                                            </div>
                                            <div class="card  col-lg-4 m-1 shadow shadow-primary">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-4">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('dist/img/icons/unicons/wallet-info.png') }}"
                                                                alt="wallet info" class="rounded">
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">No. of Admins</p>
                                                    <h4 class="card-title mb-3">{{ $admins }}</h4>
                                                    {{-- <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                                </div>
                                            </div>
                                            <div class="card  col-lg-4 m-1 shadow shadow-primary">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-4">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('dist/img/icons/unicons/wallet-info.png') }}"
                                                                alt="wallet info" class="rounded">
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">No. of Categories</p>
                                                    <h4 class="card-title mb-3">{{ $categories }}</h4>
                                                    {{-- <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                                </div>
                                            </div>
                                            <div class="card  col-lg-4 m-1 shadow shadow-primary">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-4">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('dist/img/icons/unicons/wallet-info.png') }}"
                                                                alt="wallet info" class="rounded">
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">No. of Posts</p>
                                                    <h4 class="card-title mb-3">{{ $posts }}</h4>
                                                    {{-- <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                                </div>
                                            </div>
                                            <div class="card  col-lg-3 m-1 shadow shadow-primary">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-4">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('dist/img/icons/unicons/wallet-info.png') }}"
                                                                alt="wallet info" class="rounded">
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">No. of Events</p>
                                                    <h4 class="card-title mb-3">{{ $events }}</h4>
                                                    {{-- <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                                </div>
                                            </div>
                                            <div class="card  col-lg-4 m-1 shadow shadow-primary">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-4">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('dist/img/icons/unicons/wallet-info.png') }}"
                                                                alt="wallet info" class="rounded">
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">No. of Resources</p>
                                                    <h4 class="card-title mb-3">{{ $resources }}</h4>
                                                    {{-- <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                                </div>
                                            </div>
                                            <div class="card  col-lg-4 m-1 shadow shadow-primary">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-4">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('dist/img/icons/unicons/wallet-info.png') }}"
                                                                alt="wallet info" class="rounded">
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">No. of Podcats</p>
                                                    <h4 class="card-title mb-3">{{ $podcasts }}</h4>
                                                    {{-- <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                                </div>
                                            </div>
                                            <div class="card  col-lg-4 m-1 shadow shadow-primary">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-4">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('dist/img/icons/unicons/wallet-info.png') }}"
                                                                alt="wallet info" class="rounded">
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">No. of Quizzes</p>
                                                    <h4 class="card-title mb-3">{{ $quizzes }}</h4>
                                                    {{-- <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                                </div>
                                            </div>
                                            <div class="card  col-lg-3 m-1 shadow shadow-primary">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-4">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('dist/img/icons/unicons/wallet-info.png') }}"
                                                                alt="wallet info" class="rounded">
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">No. of Services</p>
                                                    <h4 class="card-title mb-3">{{ $services }}</h4>
                                                    {{-- <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Order Statistics -->
                            </div>
                        @else
                            <div class="row">
                                
                                    <h1>Welcome to Cyber security awareness </h1>
                                    <p> {{ auth()->user()->name }} </p>
                                
                            </div>
                        @endif
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <x-footer />
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div class="buy-now">
        <a href="#top" class="btn btn-danger btn-buy-now">top</a>
    </div>

    <!-- Core JS -->
    <x-scripts />
    {{-- core js end  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(e) {
            // CSA
            // ------------------------------------------
            // --------------------------------------------------------------------
            const csaChartEl = document.querySelector("#csa"),
                csaChartConfig = {
                    series: [{
                        data: [{{ $categories }}, {{ $events }}, {{ $podcasts }},
                            {{ $posts }}, {{ $quizzes }}, {{ $resources }},
                            {{ $services }}
                        ],
                    }, ],
                    chart: {
                        height: 200,
                        parentHeightOffset: 0,
                        parentWidthOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        type: "area",
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: 3,
                        curve: "smooth",
                    },
                    legend: {
                        show: true,
                    },
                    markers: {
                        size: 6,
                        colors: "transparent",
                        strokeColors: "transparent",
                        strokeWidth: 4,
                        discrete: [{
                            fillColor: config.colors.white,
                            seriesIndex: 0,
                            dataPointIndex: 6,
                            strokeColor: config.colors.primary,
                            strokeWidth: 2,
                            size: 6,
                            radius: 8,
                        }, ],
                        offsetX: -1,
                        hover: {
                            size: 7,
                        },
                    },
                    colors: [config.colors.primary],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            gradientToColors: [config.colors.cardColor],
                            opacityTo: 0.3,
                            stops: [0, 100],
                        },
                    },
                    grid: {
                        // borderColor: borderColor,
                        strokeDashArray: 8,
                        padding: {
                            top: -20,
                            bottom: -8,
                            left: 0,
                            right: 8,
                        },
                    },
                    xaxis: {
                        categories: ["categories", "events", "podcasts", "posts", "quizzes", "resources",
                            "services"
                        ],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: true,
                            style: {
                                fontSize: "13px",
                                // colors: labelColor,
                            },
                        },
                    },
                    yaxis: {
                        labels: {
                            show: true,
                        },
                        min: 0,
                        max: 50,
                        tickAmount: 4,
                    },
                };
            if (typeof csaChartEl !== undefined && csaChartEl !== null) {
                const csaChart = new ApexCharts(csaChartEl, csaChartConfig);
                csaChart.render();
            }
        })
    </script>
</body>

</html>
