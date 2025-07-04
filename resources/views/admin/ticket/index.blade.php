<!doctype html>
<x-header title="all tickets" />

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
                                            <div class="col  dt-layout-cell table-responsive  p-2 border border-danger dt-layout-full">

                                            @if ( $tickets->isEmpty() )
                                                <div class="text-center">
                                                    <img src="{{ asset('no-image.png') }}" alt="No Data" class="img-fluid" style="max-width: 300px;">
                                                    <h5 class="mt-3">No tickets available</h5>
                                                </div>                                            @endif
                                                @foreach ( $tickets as $ticket )
                                                <div class="card shadow rounded-4 border-0 mb-4" style="width: 20rem;">
                                                    <img src="{{ $ticket->image ? asset('storage/'.$ticket->image) : asset('no-image.png') }}" class="card-img-top rounded-top-4" alt="Event Image" style="height: 200px; object-fit: cover;">
                                                    <div class="card-body">
                                                        <h5 class="card-title fw-bold mb-2">
                                                            <i class="fa-solid fa-ticket fa-fw text-primary"></i>
                                                            {{ $ticket->event->title }}
                                                        </h5>
                                                        <p class="card-text text-muted mb-3" style="font-size: 0.95rem;">
                                                            <i class="fa-solid fa-align-left fa-fw text-secondary"></i>
                                                            {{ Str::limit($ticket->description, 20, '...') }}
                                                            <br>
                                                            <i class="fa-solid fa-info-circle fa-fw text-secondary"></i>
                                                            {{ Str::limit($ticket->event->description, 30, '...') }}
                                                        </p>
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="fa-regular fa-clock fa-fw me-2 text-info"></i>
                                                            <span>
                                                                <strong>Time:</strong> {{ $ticket->start_time }} - {{ $ticket->end_time }} GMT
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="fa-regular fa-calendar-days fa-fw me-2 text-success"></i>
                                                            <span>
                                                                <strong>Date:</strong>
                                                                @php
                                                                $startDate = \Carbon\Carbon::parse($ticket->start_date);
                                                                $endDate = \Carbon\Carbon::parse($ticket->end_date);
                                                                $dateFormat = 'D, jS F, Y'; // Mon, 17th March, 2025
                                                                @endphp
                                                                @if($ticket->start_date === $ticket->end_date)
                                                                {{ $startDate->format($dateFormat) }}
                                                                @else
                                                                {{ $startDate->format($dateFormat) }} - {{ $endDate->format($dateFormat) }}
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="fa-solid fa-location-dot fa-fw me-2 text-danger"></i>
                                                            <span>
                                                                {{ $ticket->event->venue->name }}<br>
                                                                <small class="text-muted">{{ $ticket->event->venue->city }} | {{ $ticket->event->venue->phone }}</small>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body d-flex flex-column gap-2">
                                                        <span class="badge bg-primary rounded-pill px-3 py-2 mb-1">
                                                            <i class="fa-solid fa-star fa-fw"></i> {{ $ticket->ticketType->name }} ({{ $ticket->price }} GHC) avail..({{ $ticket->a_qty }})
                                                        </span>
                                                        <a href="#" class="card-link text-decoration-none text-secondary">
                                                            <i class="fa-solid fa-map-pin fa-fw"></i>
                                                            {{ $ticket->event->venue->address }}
                                                        </a>
                                                        <form action="/admin/cart/{{$ticket->id}}/store?price={{$ticket->price}}" method="POST" class="mt-2 d-flex flex-column align-items-center">
                                                            @method('POST')
                                                            @csrf
                                                            <div class="input-group mb-2" style="width:140px;">
                                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                    <i class="fab fa-minus">-</i>
                                                                </button>
                                                                <input type="number" id="quantity" name="quantity" class="form-control text-center" value="1" max="{{$ticket->qty}}" min="1" style="max-width: 70px; min-width: 50px;">
                                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                    <i class="fa fa-plus">+</i>
                                                                </button>
                                                            </div>
                                                            <button type="submit" class="btn btn-success w-100">
                                                                <i class="fa fa-cart-plus"></i> Add to Cart
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
    <script>
        var quantity=document.getElementById("quantity").value;
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
