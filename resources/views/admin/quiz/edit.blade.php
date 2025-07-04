<!doctype html>
<x-header title="{{ $quiz->name }}" />
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
                                            <h5 class="mb-1 me-2">edit quiz</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form class="row" action="/admin/quiz/{{ $quiz->id }}" method="post">
                                            @csrf
                                            @method("put")
                                            <div class="form-floating col-lg-11 m-1">
                                                <input type="text" class="form-control"  value="{{ $quiz->name }}" id="name" name="name"
                                                    placeholder="eg exams retreat" aria-describedby="floatingInputHelp" />
                                                <label for="name">name</label>
                                                @error("name")
                                                   <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <textarea placeholder="type here" class="form-control col-lg-11 m-1"  name="description" id="description" cols="30" rows="10">{{ $quiz->description }}</textarea>
                                             @error("description")
                                               <p class="text-danger">
                                                {{ $message }}
                                               </p>
                                             @enderror

                                          <input class="btn btn-primary m-3" name="update" type="submit" value="update quiz">
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
