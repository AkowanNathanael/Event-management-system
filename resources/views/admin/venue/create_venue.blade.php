<!doctype html>
<x-header title="create venue" />

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
                        <div class="row">
                            <!-- Order Statistics -->
                            <div class="col-md-6 col-lg-12 col-xl-12 order-0 mb-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1 me-2">Add Venue</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form class="row" action="/admin/venue/store" method="post">
                                            @csrf
                                            <div class="form-floating col-lg-4 m-1">
                                                <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name"
                                                    placeholder="eg John Doe" aria-describedby="floatingInputHelp" />
                                                <label for="name">Name</label>
                                                @error("name")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-7 m-1">
                                                <input type="text" class="form-control" value="{{ old('address') }}" id="address" name="address"
                                                    placeholder="eg Tamale , Ghana" aria-describedby="floatingInputHelp" />
                                                <label for="address">Address</label>
                                                @error("address")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <!-- <div class="form-floating col-lg-3 m-1">
                                                <input type="text" class="form-control" value="{{ old('address') }}" id="address" name="address"
                                                    placeholder="eg Tamale , Ghana" aria-describedby="floatingInputHelp" />
                                                <label for="address">Address</label>
                                                @error("address")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div> -->
                                            <div class="form-floating col-lg-5 m-1">
                                                <input type="text" class="form-control" value="{{ old('city') }}" id="city" name="city"
                                                    placeholder="eg Tamale , Ghana" aria-describedby="floatingInputHelp" />
                                                <label for="city">City</label>
                                                @error("city")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-3 m-1">
                                                <input type="number" class="form-control" value="{{ old('capacity') }}" id="capacity" name="capacity"
                                                    placeholder="eg 100" aria-describedby="floatingInputHelp" />
                                                <label for="capacity">Capacity</label>
                                                @error("capacity")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-3 m-1">
                                                <input type="text" class="form-control" value="{{ old('phone') }}" id="phone" name="phone"
                                                    placeholder="eg 0240000000" aria-describedby="floatingInputHelp" />
                                                <label for="phone">Phone</label>
                                                @error("phone")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-12 m-1">
                                                <input type="text" class="form-control" value="{{ old('email') }}" id="email" name="email"
                                                    placeholder="eg example@example.com" aria-describedby="floatingInputHelp" />
                                                <label for="email">Email</label>
                                                @error("email")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <input class="btn btn-primary m-3" name="submit" type="submit" value="add venue">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--/ Order Statistics -->
                        </div>
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
</body>

</html>
