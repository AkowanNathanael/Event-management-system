<!doctype html>
<x-header title="edit podcast" />

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
                                            <h5 class="mb-1 me-2">edit podcast</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form class="row" enctype="multipart/form-data"
                                            action="/admin/podcast/{{ $podcast->id }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="ima">
                                                <audio id="audio-player" 
                                                    src="{{ $podcast->audio ? asset('storage/' . $podcast->audio) : asset('no-image.png') }}" 
                                                    class="img-fluid border m-2 rounded-start" 
                                                    controls 
                                                    style="width: 300px; height: 200px; object-fit: cover;">
                                                </audio>
                                                <div class="audio-controls">
                                                    <button type="button" id="rewind" class="btn btn-secondary m-1">Rewind</button>
                                                    <button type="button" id="normal-speed" class="btn btn-secondary m-1">Normal Speed</button>
                                                    <button type="button" id="fast-forward" class="btn btn-secondary m-1">Fast Forward</button>
                                                </div>
                                            </div>
                                            <div class="form-floating col-lg-5 m-1">
                                                <input type="text" class="form-control" value="{{ $podcast->title }}"
                                                    id="title" name="title" placeholder="eg Jman corp"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="title">title</label>
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
                                                    @foreach ($categories as $cat)
                                                        @if ($cat->id == $podcast->category_id)
                                                            <option value="{{ $cat->id }}" selected>
                                                                {{ $cat->name }} </option>
                                                        @else
                                                            <option value="{{ $cat->id }}"> {{ $cat->name }}
                                                            </option>
                                                        @endif
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
                                                    value="{{ $podcast->title ? $podcast->audio : old('audio') }}"
                                                    id="image" name="audio" placeholder="fly down the sky"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="image">Audio File</label>
                                                @error('audio')
                                                    <p id="floatingInputHelp" class="form-text text-danger ">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <textarea placeholder="type here" class="form-control col-lg-11 m-1" name="description" id="description" cols="30"
                                                rows="10">{{ $podcast->description }}</textarea>
                                            @error('description')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                            <input class="btn btn-primary m-3" name="update" type="submit"
                                                value="update podcast">
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

        document.addEventListener("DOMContentLoaded", function () {
            const audioPlayer = document.getElementById("audio-player");
            const rewindButton = document.getElementById("rewind");
            const normalSpeedButton = document.getElementById("normal-speed");
            const fastForwardButton = document.getElementById("fast-forward");

            // Rewind: Decrease playback speed
            rewindButton.addEventListener("click", function () {
                audioPlayer.playbackRate = Math.max(0.5, audioPlayer.playbackRate - 0.5); // Minimum speed is 0.5x
            });

            // Normal Speed: Reset playback speed to 1x
            normalSpeedButton.addEventListener("click", function () {
                audioPlayer.playbackRate = 1;
            });

            // Fast Forward: Increase playback speed
            fastForwardButton.addEventListener("click", function () {
                audioPlayer.playbackRate = Math.min(3, audioPlayer.playbackRate + 0.5); // Maximum speed is 3x
            });
        });
    </script>
</body>

</html>
