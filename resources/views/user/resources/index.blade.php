<!doctype html>
<x-header title="all resources" />

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
                            @if ($resources->isEmpty())
                                <div class="col-12">
                                    <div class="alert alert-warning text-center" role="alert">
                                        No resources available.
                                    </div>
                                </div>
                            @else
                                @foreach ($resources as $resource)
                                    <div class="col-lg-6 mb-4">
                                        <div class="card h-100">
                                            <div class="card-header d-flex justify-content-between">
                                                <div class="card-title mb-0">
                                                    <h5 class="mb-1 me-2">{{ $resource->title }}</h5>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card mb-6 shadow border">
                                                    <div class="card-body">
                                                        <div class="ima">
                                                            @if (str_contains($resource->file, 'image'))
                                                                <img src="{{ $resource->file ? asset('storage/' . $resource->file) : asset('no-image.png') }}"
                                                                    alt="resource image"
                                                                    class="img-fluid border m-2 rounded-start"
                                                                    style="width: 400px; height: 300px; object-fit: cover;">
                                                            @elseif (str_contains($resource->file, 'video'))
                                                                <video class="img-fluid border m-2 rounded-start"
                                                                    style="width: 400px; height: 300px; object-fit: cover;"
                                                                    src="{{ asset('storage/' . $resource->file) }}"
                                                                    controls autoplay>
                                                                </video>
                                                            @else
                                                                <span
                                                                    class="d-flex align-items-center justify-content-center"
                                                                    style="width: 400px; height: 300px; background-color: #f8f9fa;">
                                                                    <i class="menu-icon tf-icons bx bx-detail"
                                                                        style="font-size: 2rem;"></i>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="card-subtitle mb-4">
                                                            {{ $resource->created_at->diffForHumans() }}
                                                        </div>
                                                        <p class="card-text">
                                                            {{ Str::words($resource->description, 15, '...') }}
                                                        </p>
                                                        {{-- <a href="/admin/resource/{{ $resource->id }}/edit"
                                                            class="card-link inline-block btn btn-success">Edit</a>
                                                        <form action="/admin/resource/{{ $resource->id }}"
                                                            class="inline-block" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button id="delete" type="submit"
                                                                class="card-link inline-block btn btn-danger">Delete</button>
                                                        </form> --}}
                                                        @if ($resource->file)
                                                            <a href="{{ asset('storage/' . $resource->file) }}"
                                                                download="{{ $resource->title }}"
                                                                class="btn text-primary border rounded-3 m-2">
                                                                Download Resource
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                @if ($resource->url)
                                                    <a target="_blank" href="{{ $resource->url }}"
                                                        class="link">Resource
                                                        URL</a>
                                                @else
                                                    <span>No URL</span>
                                                @endif
                                                <p class="lead text-center">
                                                    Type: {{ $resource->type }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {{ $resources->links() }}
                    </div>
                </div>
                <!-- / Content wrapper -->
            </div>
            <!-- / Layout container -->
        </div>
    </div>
    <a href="#top" class="btn btn-danger btn-buy-now">top</a>

    <!-- Core JS -->
    <x-scripts />
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var els = document.querySelectorAll(".option");
            els.forEach(element => {
                element.disabled = "";
            });
            console.log(els);

            new DataTable("#basic");

            const deleteButtons = document.querySelectorAll("#delete"); // Select all delete buttons
            deleteButtons.forEach(deleteButton => {
                deleteButton.addEventListener("click", function(e) {
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
        });
    </script>
    {{-- core js end  --}}
</body>

</html>
