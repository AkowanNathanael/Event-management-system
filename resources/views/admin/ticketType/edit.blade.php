<!doctype html>
<x-header title="{{ $ticketType->name }}" />

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
                                            <h5 class="mb-1 me-2">edit ticket type </h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form class="row" enctype="multipart/form-data" action="/admin/tickettype/{{ $ticketType->id }}" method="post">
                                            @csrf
                                            @method("put")
                                            <div class="form-floating col-lg-4 m-1">
                                                <input type="text" class="form-control" value="{{ $ticketType->name }}" id="name" name="name"
                                                    placeholder="eg John Doe" aria-describedby="floatingInputHelp" />
                                                <label for="name">Name</label>
                                                @error("name")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-5 m-1">
                                                <input type="benefits" class="form-control" value="{{ $ticketType->benefits }}" id="benefits" name="benefits"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="benefits">benefits</label>
                                                @error("benefits")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="bio">description</label>
                                                <textarea placeholder="Enter description" class="form-control col-lg-12 mt-3" cols="30" rows="5" name="description" id="description">{{$ticketType->description }}</textarea>
                                                @error("description")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>

                                            <input class="btn btn-primary m-3" name="update" type="submit" value="update ticket type">
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
    <script>
        const imageEl = document.getElementById("image");
        imageEl.addEventListener("change", function() {
            const file = imageEl.files[0];
            const fileSize = file.size / 1024 / 1024; // in MB
            if (fileSize > 1) {
                alert("File size is too large");
                imageEl.value = "";
            }
            if (file) {
                const url = URL.createObjectURL(file); // Corrected to use 'URL' instead of 'Url'
                const imageBox = document.getElementById("image-box");
                const newImageEl = document.createElement("img");
                newImageEl.src = url;
                newImageEl.style.width = "150px";
                newImageEl.style.height = "150px";
                imageBox.appendChild(newImageEl);
                // imageBox.style.display = "flex";
            }
        });
    </script>
</body>

</html>
