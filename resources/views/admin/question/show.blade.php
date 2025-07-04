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
                                            <h5 class="mb-1 me-2">showing quiz and questions </h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-6 shadow border">
                                            <div class="card-body">
                                                <div class="ima">
                                                    <img src="{{ $quiz->image ? asset('storage/' . $quiz->image) : asset('no-image.png') }}"
                                                        alt="post image" class="img-fluid border m-2 rounded-start"
                                                        style="width: 400px; height: 300px; object-fit: cover;">
                                                </div>
                                                <h2 class="card-title text-capitalize mb-1">{{ $quiz->name }} </h2>

                                                <div class="card-subtitle mb-4">{{ $quiz->created_at->diffForHumans() }}
                                                </div>
                                                <p class="card-text">
                                                    {{ $quiz->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c">
                                        <div class="container mt-4">
                                            <h2 class="mb-4">Questions and Options</h2>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Question</th>
                                                        <th>Options</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($quiz->questions as $index => $question)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $question->question_text }}</td>
                                                            <td>
                                                                <ul>
                                                                    @foreach ($question->options as $option)
                                                                        <li>
                                                                            <strong>{{ $option->option_label }}:</strong> {{ $option->option_text }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-info btn-sm reveal-answer" data-question-id="{{ $question->id }}">
                                                                    Show Correct Answer
                                                                </button>
                                                                <p class="correct-answer mt-2 text-success" id="correct-answer-{{ $question->id }}" style="display: none;">
                                                                    <!-- Correct answer will be displayed here -->
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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

        document.addEventListener("DOMContentLoaded", function () {
            const revealButtons = document.querySelectorAll(".reveal-answer");

            revealButtons.forEach((button) => {
                button.addEventListener("click", async function () {
                    const questionId = button.getAttribute("data-question-id");
                    const correctAnswerElement = document.getElementById(`correct-answer-${questionId}`);

                    try {
                        const response = await fetch(`/admin/question/${questionId}/correct-answer`, {
                            method: "GET",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            }
                        });

                        const data = await response.json();
                        console.log(data); // Debugging line

                        if (response.ok && data.success) {
                            correctAnswerElement.textContent = `Correct Answer: ${data.correct_answer}`;
                            correctAnswerElement.style.display = "block";
                        } else {
                            alert(data.message || "An error occurred while fetching the correct answer.");
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
</body>

</html>
