<!doctype html>
<x-header title="create podcast" />

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
                                            <h5 class="mb-1 me-2">Add podcast</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form class="row" enctype="multipart/form-data" action="/admin/podcast/store"
                                            method="post">
                                            @csrf
                                            <div class="form-floating col-lg-5 m-1">
                                                <input type="text" class="form-control" value="{{ old('title') }}"
                                                    id="title" name="title" placeholder="fly down the sky"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="title">Title</label>
                                                @error('title')
                                                    <p id="floatingInputHelp" class="form-text text-danger ">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class=" col-lg-5 m-1 border rounded-2 p-1 ">
                                                <label for="category_id" class="form-label">Category</label>
                                                <select value="{{ old('category_id') }}" id="category_id"
                                                    name="category_id" class="form-select form-select-sm">
                                                    <option value="null" selected>--choose--</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}"> {{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('category_id')
                                                    <p id="floatingInputHelp" class="form-text text-danger ">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div id="image-box" class="form-floating col-lg-11 m-1">
                                                <input type="file" accept="audio/*" class="form-control"
                                                    value="{{ old('audio') }}" id="image" name="audio"
                                                    placeholder="fly down the sky"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="image">Audio File</label>
                                                @error('audio')
                                                    <p id="floatingInputHelp" class="form-text text-danger ">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            <textarea placeholder="type here" class="form-control col-lg-11 m-1" name="description" id="description" cols="30"
                                                rows="10">{{ old('description') }}</textarea>
                                            @error('description')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                            <input class="btn btn-primary m-3" name="submit" type="submit"
                                                value="add podcast">
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
<script>
    const imageEl = document.getElementById("image");
    imageEl.addEventListener("change", function() {
        const file = imageEl.files[0];
        const fileSize = file.size / 1024 / 1024; // in MB
        if (fileSize > 10) {
            alert("File size is too large");
            imageEl.value = "";
        } else {
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
        }

    });
</script>

</html>
