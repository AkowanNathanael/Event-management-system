<!doctype html>
<x-header title="{{ $artist->name }}" />

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
                                            <h5 class="mb-1 me-2">edit artist</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form class="row" enctype="multipart/form-data" action="/admin/artist/{{ $artist->id }}" method="post">
                                            @csrf
                                            @method("put")
                                            <div class="ima">
                                                <img src="{{ $artist->image ?  asset('storage/'.$artist->image) : asset('/no-image.png') }}"
                                                    alt="post image" class="img-fluid border m-2 rounded-start"
                                                    style="width: 400px; height: 300px; object-fit: cover;">
                                            </div>
                                            <div class="form-floating col-lg-4 m-1">
                                                <input type="text" class="form-control" value="{{ $artist->name }}" id="name" name="name"
                                                    placeholder="eg John Doe" aria-describedby="floatingInputHelp" />
                                                <label for="name">Name</label>
                                                @error("name")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div id="image-box" class="form-floating col-lg-7 m-1">
                                                <input accept="image/*" type="file" class="form-control" value="" id="image" name="image"
                                                    placeholder="" aria-describedby="floatingInputHelp" />
                                                <label for="address">image</label>
                                                @error("image")
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
                                                <input type="url" class="form-control" value="{{ $artist->website }}" id="website" name="website"
                                                    placeholder="eg https://example.com" aria-describedby="floatingInputHelp" />
                                                <label for="website">Website</label>
                                                @error("website")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-3 m-1">
                                                <select name="genre" id="genre" class="form-select">
                                                    <option value="">Select Genre</option>
                                                    <option value="rock" {{ $artist->genre == 'rock' ? 'selected' : '' }}>Rock</option>
                                                    <option value="pop" {{ $artist->genre == 'pop' ? 'selected' : '' }}>Pop</option>
                                                    <option value="jazz" {{ $artist->genre == 'jazz' ? 'selected' : '' }}>Jazz</option>
                                                </select>
                                                <label for="genre">Genre</label>
                                                @error("genre")
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <textarea placeholder="Enter artist bio" class="form-control col-lg-12 mt-3" cols="30" rows="5" name="bio" id="bio">{{ $artist->bio }}</textarea>
                                            <label for="bio">Bio</label>
                                            @error("bio")
                                            <p id="floatingInputHelp" class="form-text text-danger ">
                                                {{ $message }}
                                            </p>
                                            @enderror

                                            <input class="btn btn-primary m-3" name="update" type="submit" value="update artist">
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
