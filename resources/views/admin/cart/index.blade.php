<!doctype html>
<x-header title="{{ auth()->user()->name }}: tickets" />

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
                                            <h5 class="mb-1 me-2">all tickets</h5>
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

                                        <div class="dt-layout-row dt-layout-table">
                                            <div class="row col dt-layout-cell table-responsive p-2 border border-danger dt-layout-full">

                                                {{-- Total Cost --}}
                                                @php
                                                $total = 0;
                                                foreach($carts as $cart) {
                                                $total += $cart->ticket->price * $cart->quantity;
                                                }
                                                @endphp
                                                @isset($cart)
                                                <div class="alert alert-info fw-bold mb-4 d-flex justify-content-between align-items-center" style="font-size: 1.2rem;">
                                                    <span>
                                                        Total Cost: <span class="text-success">{{ number_format($total, 2) }} GHS</span>
                                                    </span>
                                                    <button class="btn btn-primary ms-3" onclick="document.getElementById('paymentModal').style.display='block'">
                                                        <i class="fa fa-credit-card"></i> Pay
                                                    </button>
                                                </div>
                                                @endisset


                                                <!-- Payment Modal/Form -->
                                                <div id="paymentModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); z-index:9999;">
                                                    <div style="background:#fff; max-width:400px; margin:5% auto; padding:2rem; border-radius:10px; position:relative;">
                                                        <button type="button" class="btn-close" aria-label="Close" style="position:absolute; top:10px; right:10px;" onclick="document.getElementById('paymentModal').style.display='none'"></button>
                                                        <form id="paymentForm">
                                                            <div class="form-group mb-2">
                                                                <label for="email-address">Email Address</label>
                                                                <input value="{{ auth()->user()->email}}" type="email"
                                                                    name="email-address"
                                                                    id="email-address" class="form-control" required />
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="amount">Amount</label>
                                                                <input step="0.01" type="number" id="amount" class="form-control" value="{{ number_format($total, 2) }}" readonly />
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="first-name">First Name</label>
                                                                <input placeholder="enter first name on Ghanacard" required type="text" id="first-name" class="form-control" />
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="middle-name">Middle Name</label>
                                                                <input type="text" name="middle-name" id="middle-name" class="form-control" />
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="last-name">Last Name</label>
                                                                <input placeholder="enter last name on Ghanacard" type="text" id="last-name" class="form-control" />
                                                            </div>
                                                            <div class="form-submit mt-3">
                                                                <button type="submit">Pay</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                @if ( $carts->isEmpty() )
                                                <div class="text-center">
                                                    <img src="{{ asset('no-image.png') }}" alt="No Data" class="img-fluid" style="max-width: 300px;">
                                                    <h5 class="mt-3">No tickets available</h5>
                                                </div>
                                                @endif
                                                @foreach ( $carts as $cart )
                                                <div class="card col-3 shadow rounded-4 border-0 mb-4" style="width: 20rem;">
                                                    <img src="{{ $cart->ticket->image ? asset('storage/'.$cart->ticket->image) : asset('no-image.png') }}" class="card-img-top rounded-top-4" alt="Event Image" style="height: 200px; object-fit: cover;">
                                                    <div class="card-body">
                                                        <h5 class="card-title fw-bold mb-2">
                                                            <i class="fa-solid fa-ticket fa-fw text-primary"></i>
                                                            {{ $cart->ticket->event->title }}
                                                        </h5>
                                                        <p class="card-text text-muted mb-3" style="font-size: 0.95rem;">
                                                            <i class="fa-solid fa-align-left fa-fw text-secondary"></i>
                                                            {{ Str::limit($cart->ticket->description, 20, '...') }}
                                                            <br>
                                                            <i class="fa-solid fa-info-circle fa-fw text-secondary"></i>
                                                            {{ Str::limit($cart->ticket->event->description, 30, '...') }}
                                                        </p>
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="fa-regular fa-clock fa-fw me-2 text-info"></i>
                                                            <span>
                                                                <strong>Time:</strong> {{ $cart->ticket->start_time }} - {{ $cart->ticket->end_time }} GMT
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="fa-regular fa-calendar-days fa-fw me-2 text-success"></i>
                                                            <span>
                                                                <strong>Date:</strong>
                                                                @php
                                                                $startDate = \Carbon\Carbon::parse($cart->ticket->start_date);
                                                                $endDate = \Carbon\Carbon::parse($cart->ticket->end_date);
                                                                $dateFormat = 'D, jS F, Y'; // Mon, 17th March, 2025
                                                                @endphp
                                                                @if($cart->ticket->start_date === $cart->ticket->end_date)
                                                                {{ $startDate->format($dateFormat) }}
                                                                @else
                                                                {{ $startDate->format($dateFormat) }} - {{ $endDate->format($dateFormat) }}
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="fa-solid fa-location-dot fa-fw me-2 text-danger"></i>
                                                            <span>
                                                                {{ $cart->ticket->event->venue->name }}<br>
                                                                <small class="text-muted">{{ $cart->ticket->event->venue->city }} | {{ $cart->ticket->event->venue->phone }}</small>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body d-flex flex-column gap-2">
                                                        <span class="badge bg-primary rounded-pill px-3 py-2 mb-1">
                                                            <i class="fa-solid fa-star fa-fw"></i> {{ $cart->ticket->ticketType->name }} ({{ $cart->ticket->price }} GHC) avail..({{ $cart->ticket->a_qty }})
                                                        </span>
                                                        <a href="#" class="card-link text-decoration-none text-secondary">
                                                            <i class="fa-solid fa-map-pin fa-fw"></i>
                                                            {{ $cart->ticket->event->venue->address }}
                                                        </a>
                                                        <form action="/admin/cart/{{$cart->id}}/{{$cart->ticket->id}}?a_qty={{$cart->ticket->a_qty }}" method="POST" class="mt-2 d-flex flex-column align-items-center">
                                                            @method('DELETE')
                                                            @csrf
                                                            <div class="input-group mb-2" style="width:140px;">
                                                                <!-- <button disabled type="button" class="btn btn-outline-secondary btn-sm" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                    <i class="fab fa-minus">-</i>
                                                                </button> -->
                                                                <input readonly type="number" id="quantity" name="quantity" class="form-control text-center" value="{{$cart->quantity}}" style="max-width: 70px; min-width: 50px;">
                                                                <!-- <button disabled type="button" class="btn btn-outline-secondary btn-sm" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                    <i class="fa fa-plus">+</i>
                                                                </button> -->
                                                            </div>
                                                            <button type="submit" class="btn btn-success w-100">
                                                                <i class="fa fa-cart-plus"></i> remove
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                @endforeach
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
    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            const email = document.getElementById('email-address').value;
            const amount = document.getElementById('amount').value.replace(/,/g, ''); // Remove commas
            const firstName = document.getElementById('first-name').value;
            const middlename = document.getElementById('middle-name').value;
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
                        "middle-name": document.getElementById('middle-name').value,
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