<!doctype html>
<x-header title="{{ $podcast->title }}" />

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
                        <div class="row"></div>
                            <!-- Order Statistics -->
                            <div class="col-md-6 col-lg-12 col-xl-12 order-0 mb-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1 me-2">View podcast </h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-6 shadow border">
                                            <div class="card-body">
                                                <div style="position: relative" class="ima">
                                                    <audio id="audio-player" 
                                                        src="{{ asset('storage/'.$podcast->audio) }}" 
                                                        alt="podcast file" 
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
                                                <h2 class="card-title text-capitalize mb-1">{{ $podcast->title }}</h2>
                                                <div class="card-subtitle mb-4">{{ $podcast->created_at->diffForHumans() }}</div>
                                                <p class="card-text">
                                                    {{ $podcast->description }}
                                                </p>
                                                {{-- <a href="/admin/podcast/{{ $podcast->id }}/edit" class="card-link inline-block btn btn-success">Edit</a>
                                                <form action="/admin/podcast/{{ $podcast->id }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method("delete")
                                                    <button id="delete" type="submit" class="card-link inline-block btn btn-danger">Delete</button>
                                                </form> --}}
                                            </div>
                                        </div>
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
           const deleteButtons = document.querySelectorAll("#delete"); // Select all delete buttons
    deleteButtons.forEach(deleteButton => {
        deleteButton.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent the default form submission
            const form = e.target.closest("form"); // Get the closest parent form
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form programmatically
                }
            });
        });
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
