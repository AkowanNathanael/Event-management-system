<!doctype html>
<x-header title="{{ $quiz->name }}" />
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
                                            <h5 class="mb-1 me-2">View quiz</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-6 shadow border">
                                            <div class="card-body">
                                                <h5 class="card-title mb-1">{{ $quiz->name }}</h5>
                                                <div class="card-subtitle mb-4">{{ $quiz->created_at->diffForHumans() }}</div>
                                                <p class="card-text">
                                                    {{ $quiz->description }}
                                                </p>
                                                <a href="/admin/quiz/{{ $quiz->id }}/edit" class="card-link inline-block btn btn-success">edit</a>
                                                <form class="inline-block" action="/admin/quiz/{{ $quiz->id  }}" method="post">
                                                    @csrf
                                                    @method("delete")
                                                    <button id="delete" type="submit" class="card-link inline-block btn btn-danger">delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-2 p-2 shadow shadow-md">
                                        <form action="" method="post">
                                            @csrf
                                            @method('post')
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="question_text">Question Text</label>
                                                <input required class="form-control"  type="text" name="question_text" id="question_text" />
                                            </div>
                                             <div class="form-floating col-lg-11 m-1">
                                                <label for="question_text">Alternative A</label>
                                                <input placeholder="" required class="form-control"  type="text" name="question_text" id="question_text" />
                                            </div>
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="question_text">Alternative B</label>
                                                <input placeholder="" required class="form-control"  type="text" name="question_text" id="question_text" />
                                            </div>
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="question_text">Alternative C</label>
                                                <input placeholder="" required class="form-control"  type="text" name="question_text" id="question_text" />
                                            </div>
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="question_text">Alternative D</label>
                                                <input placeholder=""  class="form-control"  type="text" name="question_text" id="question_text" />
                                            </div>
                                            <input type="submit" class="m-2 btn btn-primary" value="add question" name="add_question" id="add_question">
                                        </form>

                                    </div>
                                    <div class="m-2 p-2 shadow shadow-md">
                                        <table class="table table-striped table-outline-primary ">
                                            <tr class="bg-secondary ">
                                              <th class="text-white">
                                                Question
                                              </th>
                                               <th class="text-white">
                                                a
                                              </th>
                                               <th class="text-white">
                                                b
                                              </th>
                                              <th class="text-white">
                                                c
                                              </th>
                                              <th class="text-white">
                                                d
                                              </th>
                                              <th class="text-white">
                                                Action
                                              </th>
                                            </tr>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
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
