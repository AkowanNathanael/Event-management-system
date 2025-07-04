<!doctype html>
<x-header title="create resource" />

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
                                            <h5 class="mb-1 me-2">Add Resource</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form class="row" enctype="multipart/form-data"
                                            action="/admin/resource/store" method="post">
                                            @csrf
                                            <div class="form-floating col-lg-11 m-1">
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
                                            <div id="image-box" class="form-floating col-lg-11 m-1">
                                                <input type="file" accept="image/*,video/*,.doc,.docx,.pdf,.ppt,.pptx,.txt,.xls,.xlsx" class="form-control"
                                                    value="{{ old('file') }}" id="file" name="file"
                                                    placeholder="choose a file" aria-describedby="floatingInputHelp" />
                                                <label for="file">Resource File</label>
                                                @error('file')
                                                    <p id="floatingInputHelp" class="form-text text-danger ">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="mb-4  col-lg-5">
                                                <label for="exampleFormControlInput1" class="form-label">
                                                    Resource Type</label>
                                                <select class="form-select" name="type" id="type">
                                                    <option value=".." selected>...</option>
                                                    <option value="video">video</option>
                                                    <option value="image">image</option>
                                                    <option value="document">document</option>
                                                </select>

                                                @error('type')
                                                    <p class="text-danger">
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
                                            <div class="form-floating col-lg-11 m-1">
                                                <input type="url" class="form-control" value="{{ old('url') }}"
                                                    id="url" value="{{ old('url') }}" name="url"
                                                    placeholder="htttp:/www.google.com"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="url">Url</label>
                                                @error('url')
                                                    <p id="floatingInputHelp" class="form-text text-danger ">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <input class="btn btn-primary m-3" name="submit" type="submit"
                                                value="add resource">
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
    const imageEl = document.getElementById("file");
    imageEl.addEventListener("change", function() {
        document.querySelector("#image-box")?.children["2"]?.remove()
        const file = imageEl.files[0];
        const fileSize = file.size / 1024 / 1024; // in MB
        console.log(file) ;console.log(file.type.includes("image"));
        const filename=file.name
        if (fileSize > 20) {
            alert("File size is too large");
            imageEl.value = "";
        }
        if (file ) {
            const url = URL.createObjectURL(file); // Corrected to use 'URL' instead of 'Url'
            const imageBox = document.getElementById("image-box");
            const newImageEl = document.createElement("img");
            newImageEl.src = url;
               newImageEl.alt = filename;
            newImageEl.style.width = "150px";
            newImageEl.style.height = "150px";
            imageBox.appendChild(newImageEl);
            // imageBox.style.display = "flex";
        }
    });
</script>

</html>
