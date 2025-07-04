<!doctype html>
<x-header title="{{ $event->title }}" />

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
                                            <h5 class="mb-1 me-2">View event </h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-6 shadow border">
                                            <div class="card-body">
                                                <h5 class="card-title mb-1">{{ $event->title }}</h5>
                                                <div class="ima">
                                                    <img src="{{ $event->image? asset('storage/' . $event->image) : asset('no-image.png') }}" alt="post image" class="img-fluid border m-2 rounded-start" style="width: 400px; height: 300px; object-fit: cover;">
                                                </div>
                                                <div class="card-subtitle mb-4">{{ $event->created_at->diffForHumans() }}</div>
                                                <p class="card-text">
                                                    {{ $event->description }}
                                                </p>
                                                <a href="/admin/event/{{ $event->id }}/edit" class="card-link inline-block btn btn-success">edit</a>
                                                <form action="/admin/event/{{ $event->id  }}" method="post">
                                                    @csrf
                                                    @method("delete")
                                                    <button id="delete" type="submit" class="card-link inline-block btn btn-danger">delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        @if ($event->url)
                                        <a target="_blank" href="{{ $event->url }}" class="link">event url</a>
                                           @else
                                        <span> no url</span>
                                        @endif
                                         
                                         <p class="lead text-center">
                                            from: {{ $event->start_date }} to {{ $event->end_date }}
                                         </p>
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
    </script>
</body>

</html>
