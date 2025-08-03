<!doctype html>
<x-header title="{{ auth()->user()->name }}: ticket ordered" />

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
                                            <h5 class="mb-1 me-2">all ticket ordered</h5>
                                        </div>
                                        @error('quantity')
                                        <x-message message="{{ $message }}" alert="alert-danger" />
                                        @enderror
                                        @if ( session("message"))
                                        <x-message message="{{ session('message') }}" alert="alert-success" />

                                        @elseif (session("delete"))
                                        <x-message message="{{ session('delete') }}" alert="alert-danger" />
                                        @elseif (session("update"))
                                        <x-message message="{{ session('update') }}" alert="alert-success" />
                                        @endif

                                    </div>
                                    <div class="card-body">
                                        {{-- --}}
                                        @if($receipts->isEmpty())
                                        <div class="text-center my-5">
                                            <img src="{{ asset('no-image.png') }}" alt="No Receipts" class="img-fluid" style="max-width: 300px;">
                                            <h5 class="mt-3">No receipts found</h5>
                                        </div>
                                        @else
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered align-middle">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>User</th>
                                                        <!-- <th>Cart ID</th> -->
                                                        <th>Quantity</th>
                                                        <th>Owner</th>
                                                        <th>Reference</th>
                                                        <th>Status</th>
                                                        <th>File</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($receipts as $receipt)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ optional($receipt->user)->name ?? 'N/A' }}</td>
                                                        <!-- <td>{{ $receipt->cart_id }}</td> -->
                                                        <td>{{ $receipt->quantity }}</td>
                                                        <td>{{ $receipt->owner }}</td>
                                                        <td>{{ $receipt->reference }}</td>
                                                        <td>
                                                            @if($receipt->status === 'paid')
                                                            <span class="badge bg-success">Paid</span>
                                                            @else
                                                            <span class="badge bg-danger">Cancelled</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($receipt->file)
                                                            <a href="{{ asset('storage/'.$receipt->file) }}" target="_blank" class="btn btn-sm btn-primary">
                                                                View PDF
                                                            </a>
                                                            @else
                                                            N/A
                                                            @endif
                                                        </td>
                                                        <td>{{ $receipt->created_at->format('d M, Y H:i') }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif

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
    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            const email = document.getElementById('email-address').value;
            const amount = document.getElementById('amount').value.replace(/,/g, ''); // Remove commas
            const firstName = document.getElementById('first-name').value;
            const lastName = document.getElementById('last-name').value;
            if (!email || !amount || !firstName || !lastName) {
                alert('Please fill in all fields.');
                return;
            }
            // Convert amount to kobo (1 GHS = 100 kobo)
            const amountInKobo = parseFloat(amount) * 100;
            const paystack = new PaystackPop();
            paystack.newTransaction({
                key: "{{ env('PAYSTACK_PUBLIC_KEY') }}", // Replace with your public key
                email: email,
                amount: amountInKobo,
                currency: 'GHS',
                // channels: ['mobile_money']
                firstName: firstName,
                lastName: lastName,
                onSuccess: (transaction) => {
                    alert(`Payment complete! Reference: ${transaction.reference}`);
                    document.getElementById('paymentModal').style.display = 'none';

                    // Prepare data to send
                    const data = {
                        reference: transaction.reference,
                        "email-address": document.getElementById('email-address').value,
                        amount: document.getElementById('amount').value.replace(/,/g, ''),
                        "first-name": document.getElementById('first-name').value,
                        "last-name": document.getElementById('last-name').value,
                        // add more fields if needed
                    };

                    fetch('/api/receipt?user={{auth()->user()->id}}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Server error');
                            // const data = response.json();
                            // console.log(data);
                            return data;
                        })
                        .then(json => {
                            // handle success
                            console.log('Receipt generated successfully:', json);
                            alert('Receipt generated successfully! Check your email for the receipt.');
                        })
                        .catch(error => {
                            alert(' client error:Failed to generate receipt: ' + error.message);
                        });
                },
                onCancel: () => {
                    alert('Transaction was cancelled');
                },
                onLoad: (response) => {
                    console.log("onLoad: ", response);
                },
                onError: (error) => {
                    alert(`Error: ${error.message}`);
                    console.log("Error: ", error.message);
                }
            });
        });

        // const popup = new PaystackPop()

        // popup.newTransaction({
        //     key: 'pk_domain_xxxxxx',
        //     email: 'sample@email.com',
        //     amount: 23400,
        //     onSuccess: (transaction) => {
        //         console.log(transaction);
        //     },
        //     onLoad: (response) => {
        //         console.log("onLoad: ", response);
        //     },
        //     onCancel: () => {
        //         console.log("onCancel");
        //     },
        //     onError: (error) => {
        //         console.log("Error: ", error.message);
        //     }
        // })

        // popup.checkout({
        //     key: 'pk_domain_xxxxxx',
        //     email: 'sample@email.com',
        //     amount: 23400,
        //     onSuccess: (transaction) => {
        //         console.log(transaction);
        //     },
        //     onLoad: (response) => {
        //         console.log("onLoad: ", response);
        //     },
        //     onCancel: () => {
        //         console.log("onCancel");
        //     },
        //     onError: (error) => {
        //         console.log("Error: ", error.message);
        //     }
        // })
        var quantity = document.getElementById("quantity").value;
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
