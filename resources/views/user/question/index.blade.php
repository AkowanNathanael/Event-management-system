<!doctype html>
<x-header title="all category" />

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
                                            <h5 class="mb-1 me-2">all post</h5>
                                        </div>
                                        @if ( session("message"))
                                            <x-message message="{{ session('message') }}" alert="alert-success" />
                                        
                                        @elseif (session("delete"))
                                             <x-message message="{{ session('delete') }}" alert="alert-danger" />
                                        @elseif (session("update"))
                                             <x-message message="{{ session('update') }}" alert="alert-success" />
                                        @endif

                                    </div>
                                    <div class="card-body">
                                        {{--  --}}

                                        <div class="dt-layout-row dt-layout-table">
                                            <div class="dt-layout-cell table-responsive  dt-layout-full">
                                                <table id="basic" class="table dataTable border "
                                                    aria-describedby="basic_info" style="width: 100%;">
                                            
                                                    <thead>
                                                        <tr>
                                                            <th data-dt-column="0" rowspan="1" colspan="1"
                                                                class="dt-orderable-asc dt-orderable-desc dt-ordering-asc"
                                                                aria-sort="ascending">Name</th>
                                                            <th data-dt-column="1" rowspan="1" colspan="1"
                                                                class="dt-orderable-asc dt-orderable-desc">Description
                                                            </th>

                                                            <th data-dt-column="4" rowspan="1" colspan="1"
                                                                class="dt-orderable-asc dt-orderable-desc"><span
                                                                    class="dt-column-title">Actions</span><span
                                                                    class="dt-column-order" role="button"
                                                                    aria-label="Actions: Activate to sort"
                                                                    tabindex="0"></span></th>
                                                             <th data-dt-column="1" rowspan="1" colspan="1"
                                                                class="dt-orderable-asc dt-orderable-desc">Add question
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        @foreach ($quizzes as $quiz )
                                                            <tr>
                                                            <td class="sorting_1">
                                                                {{-- <i
                                                                    class="icon-base bx bxl-angular icon-md text-danger me-4"></i> --}}
                                                                <span>{{ $quiz->title }}</span>
                                                            </td>
                                                            <td> {{  Str::words( $quiz->description,15, '...') }}</td>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button id="option" type="button" disabled="disabled"
                                                                        class="btn p-0 option dropdown-toggle hide-arrow"
                                                                        data-bs-toggle="dropdown">
                                                                        <i
                                                                            class="icon-base bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="/admin/post/{{$post->id }}/edit"><i
                                                                                class="icon-base bx bx-edit-alt me-1"></i>
                                                                            Edit</a>
                                                                        <form action="/admin/post/{{$post->id }}" method="post">
                                                                            @csrf
                                                                            @method("delete")
                                                                            <button id="delete" type="submit" class="dropdown-item" 
                                                                            ><i
                                                                                class="icon-base bx bx-trash me-1"></i>
                                                                            Delete</button>
                                                                        </form>

                                                                            <a class="dropdown-item"
                                                                            href="/admin/post/{{ $post->id }}"><i
                                                                                class="icon-base bx bx-calendar me-1"></i>
                                                                            view</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="/admn/add-question/{{  }}" target="_blank" rel="noopener noreferrer"></a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                    <tfoot></tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div style="width: 100%; height: 0px;" class="dt-autosize"></div>
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
    <script>
document.addEventListener("DOMContentLoaded", function () {
    var els = document.querySelectorAll(".option");
    els.forEach(element => {
        element.disabled = "";
    });
    console.log(els);

    new DataTable("#basic");

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
});
</script>
    {{-- core js end  --}}
</body>

</html>
