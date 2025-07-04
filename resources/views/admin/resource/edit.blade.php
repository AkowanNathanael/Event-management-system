<!doctype html>
<x-header title="edit resource" />

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
                                            <h5 class="mb-1 me-2">edit resource</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form class="row" enctype="multipart/form-data"
                                            action="/admin/resource/{{ $resource->id }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="ima">
                                                @if (str_contains($resource->file,"image"))
                                                        <img src="{{ $resource->file? asset('storage/' . $resource->file) : asset('no-image.png') }}" alt="post image" class="img-fluid border m-2 rounded-start" style="width: 400px; height: 300px; object-fit: cover;">
                                                   @elseif (str_contains($resource->file,"video"))
                                                        <video class="img-fluid border m-2 rounded-start"  style="width: 400px; height: 300px; object-fit: cover;"  src="{{ asset('storage/' . $resource->file) }}" controls autoplay></video>
                                                        @else
                                                        <span width="200px" height="200px" class="inline-block">
                                                            <i class="menu-icon tf-icons bx bx-detail"></i>
                                                        </span>
                                                   @endif
                                            </div>
                                            <div class="form-floating col-lg-11 m-1">
                                                <input type="text" class="form-control" value="{{ $resource->title }}"
                                                    id="title" name="title" placeholder="eg Jman corp"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="title">title</label>
                                                @error('title')
                                                    <p id="floatingInputHelp" class="form-text text-danger ">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                             <div id="image-box" class="form-floating col-lg-11 m-1">
                                                <input type="file" accept="image/*,video/*,.doc,.docx,.ppt,.pptx,.pdf,.xlxs,.csv" class="form-control"
                                                    value="{{ $resource->file }}" id="file" name="file"
                                                    placeholder="fly down the sky"
                                                    aria-describedby="floatingInputHelp" />
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
                                                <select required class="form-select" name="type" id="type">
                                                    
                                                    <option {{$resource->type=='video'? 'selected' : ''  }} value="video">video</option>
                                                    <option {{$resource->type=='image'? 'selected' : ''  }} value="image">image</option>
                                                    <option {{$resource->type=='document'? 'selected' : ''  }} value="document">document</option>
                                                </select>

                                                @error('type')
                                                    <p class="text-danger">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            <textarea placeholder="type here" class="form-control col-lg-11 m-1" name="description" id="description" cols="30"
                                                rows="10">{{ $resource->description }}</textarea>
                                            @error('description')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                            <div class="form-floating col-lg-11 m-1">
                                                <input type="url" class="form-control" value="{{ $resource->url }}"
                                                    id="url"  name="url"
                                                    placeholder="htttp:/www.google.com"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="url">Url</label>
                                                @error('url')
                                                    <p id="floatingInputHelp" class="form-text text-danger ">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <input class="btn btn-primary m-3" name="update" type="submit"
                                                value="update resource">
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
</body>

</html>
