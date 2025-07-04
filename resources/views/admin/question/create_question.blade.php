<!doctype html>
<x-header title="all question" />
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
                        <div class="container mt-4">
                
                            <h2>Manage Questions</h2>

                            <!-- New Question Button -->
                            <button type="button" class="btn btn-success mb-3" id="openNewQuestionModal">New Question</button>

                            <!-- Modal for New Question -->
                            <div class="modal fade" id="newQuestionModal" tabindex="-1" aria-labelledby="newQuestionModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="newQuestionModalLabel">Add New Question</h5>
                                    <button type="button" class="btn-close" id="closeNewQuestionModal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <form id="modal-add-question-form">
                                        @csrf
                                        <input type="hidden" id="modal_current_question_id" name="modal_current_question_id" value="">
                                        <div class="form-floating mb-3">
                                            <label for="modal_question_text">Question Text</label>
                                            <input required class="form-control" type="text" name="modal_question_text" id="modal_question_text" />
                                        </div>
                                        <button id="modal_submit_question" type="button" class="btn btn-primary mb-3">Submit Question</button>
                                        <div class="mt-4">
                                            <h6>Options</h6>
                                            @foreach(['A','B','C','D'] as $opt)
                                            <div class="input-group mb-2">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio" name="modal_iscorrect" value="{{ $opt }}">
                                                </div>
                                                <input type="text" class="form-control" placeholder="Alternative {{ $opt }}" id="modal_option_text{{ strtolower($opt) }}" name="modal_option_text{{ strtolower($opt) }}">
                                                <input type="text" class="form-control" readonly name="modal_option_label{{ $opt }}" value="{{ $opt }}">
                                                <button type="button" class="btn btn-primary modal-submit-label" data-label-id="modal_option_text{{ strtolower($opt) }}" data-radio-value="{{ $opt }}">Submit</button>
                                            </div>
                                            @endforeach
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                    
                            <!-- Questions Table -->
                            <div class="mt-4">
                                <h4>Existing Questions</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>Options</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quiz->questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $question->question_text }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($question->options as $option)
                                                            <li><strong>{{ $option->option_label }}:</strong> {{ $option->option_text }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <form action="/admin/question/{{ $question->id }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    <!-- Bootstrap 5 JS (required for modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

    // const submitButton = document.getElementById("submit_question");
    // submitButton.addEventListener("click", async function () {
    //     const questionText = document.getElementById("question_text").value;

    //     if (!questionText) {
    //         alert("Please enter a question text.");
    //         return;
    //     }

    //     try {
    //         // Send the question text and quiz ID first
    //         const response = await fetch("/admin/question/store", {
    //             method: "POST",
    //             headers: {
    //                 "Content-Type": "application/json",
    //                 "X-CSRF-TOKEN": "{{ csrf_token() }}"
    //             },
    //             body: JSON.stringify({
    //                 question_text: questionText,
    //                 quiz_id: "{{ $quiz->id }}"
    //             })
    //         });

    //         const data = await response.json();

    //         if (response.ok && data.success) {
    //             alert("Question added successfully!");
    //             console.log(data);

    //             // Store the question_id in a hidden input field
    //             document.getElementById("current_question_id").value = data.data.question_id;
    //             document.getElementById("question_text").disabled = true;
    //         } else {
    //             alert(data.message || "An error occurred while adding the question.");
    //         }
    //     } catch (error) {
    //         console.error("Error:", error);
    //         alert("An error occurred. Please try again.");
    //     }
    // });

    const submitButtons = document.querySelectorAll(".submit-label");

    submitButtons.forEach((button) => {
        button.addEventListener("click", async function () {
            const labelId = button.getAttribute("data-label-id");
            const radioValue = button.getAttribute("data-radio-value");
            const labelInput = document.getElementById(labelId);
            const optionLabelElement = document.querySelector(`input[name="option_label${radioValue}"]`);
            const isCorrectElement = document.querySelector(`input[name="iscorrect"][value="${radioValue}"]`);
            const questionId = document.getElementById("current_question_id").value; // Get the current question ID

            // Check if labelInput exists
            if (!labelInput) {
                console.error(`Label input with ID "${labelId}" not found.`);
                alert(`Label input with ID "${labelId}" not found.`);
                return;
            }

            // Check if optionLabelElement exists
            if (!optionLabelElement) {
                console.error(`Option label with name "option_label${radioValue}" not found.`);
                alert(`Option label with name "option_label${radioValue}" not found.`);
                return;
            }

            // Check if isCorrectElement exists
            if (!isCorrectElement) {
                console.error(`Radio button with value "${radioValue}" not found.`);
                alert(`Radio button with value "${radioValue}" not found.`);
                return;
            }

            const optionLabel = optionLabelElement.value;
            const isCorrect = isCorrectElement.checked;

            if (!labelInput.value) {
                alert("Please fill in the label before submitting.");
                return;
            }

            try {
                const response = await fetch("/admin/add-question-label", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        option_text: labelInput.value, // The text of the option
                        option_label: optionLabel, // The label of the option (e.g., "A", "B", etc.)
                        is_correct: isCorrect, // Whether this option is correct
                        question_id: questionId // Use the current question ID
                    })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    alert("Option submitted successfully!");
                    console.log(data);
                    labelInput.disabled = true; // Disable the input field
                    button.disabled = true; // Disable the button
                } else {
                    console.log(data.message);
                    alert(data.message || "An error occurred while submitting the option.");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        });
    });

    // Show modal
    document.getElementById("openNewQuestionModal").onclick = function() {
        var modal = new bootstrap.Modal(document.getElementById('newQuestionModal'));
        modal.show();
        window._modalInstance = modal;
    };

    // Close modal
    document.getElementById("closeNewQuestionModal").onclick = function() {
        if(window._modalInstance) window._modalInstance.hide();
        location.reload(); // Refresh the page after closing the modal
    };

    // Submit question in modal
    document.getElementById("modal_submit_question").onclick = async function() {
        const questionText = document.getElementById("modal_question_text").value;
        if (!questionText) {
            alert("Please enter a question text.");
            return;
        }
        try {
            const response = await fetch("/admin/question/store", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    question_text: questionText,
                    quiz_id: "{{ $quiz->id }}"
                })
            });
            const data = await response.json();
            if (response.ok && data.success) {
                alert("Question added successfully!");
                document.getElementById("modal_question_text").readOnly = true;
                document.getElementById("modal_current_question_id").value = data.data.question_id;
            }
        } catch (error) {
            alert("An error occurred. Please try again.");
        }
    };

    // Submit each option in modal
    document.querySelectorAll(".modal-submit-label").forEach((button) => {
        button.addEventListener("click", async function () {
            const labelId = button.getAttribute("data-label-id");
            const radioValue = button.getAttribute("data-radio-value");
            const labelInput = document.getElementById(labelId);
            const optionLabelElement = document.querySelector(`input[name="modal_option_label${radioValue}"]`);
            const isCorrectElement = document.querySelector(`input[name="modal_iscorrect"][value="${radioValue}"]`);
            const questionId = document.getElementById("modal_current_question_id").value;

            if (!labelInput.value) {
                alert("Please fill in the label before submitting.");
                return;
            }
            if (!questionId) {
                alert("Please submit the question first.");
                return;
            }

            try {
                const response = await fetch("/admin/add-question-label", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        option_text: labelInput.value,
                        option_label: optionLabelElement.value,
                        is_correct: isCorrectElement.checked,
                        question_id: questionId
                    })
                });
                const data = await response.json();
                if (response.ok && data.success) {
                    alert("Option submitted successfully!");
                    labelInput.readOnly = true;
                    button.disabled = true;
                }
            } catch (error) {
                alert("An error occurred. Please try again.");
            }
        });
    });
});
</script>
    {{-- core js end  --}}
</body>
</html>

