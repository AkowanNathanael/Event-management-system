<!doctype html>
<x-header title="Verify receipt" />

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
                            <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1 me-2">Verify receipt payment</h5>
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

                                        <form action="" id="searchform" method="get" class="row">
                                            <div class="input-group mb-3">
                                                <input type="search" id="search" class="form-control outline-none" placeholder="search reference here" aria-label="search reference here" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">search</button>
                                            </div>
                                        </form>

                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered align-middle">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Receipt no</th>
                                                        <th>Quantity</th>
                                                        <th>Owner</th>
                                                        <th>Reference</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
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
    <!-- <script src="https://js.paystack.co/v2/inline.js"></script> -->
    <script>
        async function searchData(url) {
            const response = await fetch("")
        }
        document.getElementById('searchform').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            const searchTerm = document.getElementById("search");

            if (searchTerm) {
                alert(searchTerm.value);
                const searchedTermValue = searchTerm.value;
                var myData = [];
                let tbody = document.querySelector("tbody");
                tbody.innerHTML = ""; // Clear previous results
                fetch("/admin/receipt/find", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        reference: searchedTermValue
                    })
                }).then((response) => response.json()).then((data) => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        myData.push(data.receipt);
                        myData.forEach(item => {
                            const row = document.createElement("tr");
                            row.innerHTML = `
                                <td>${item.id}</td>
                                <td>${item.quantity}</td>
                                <td>${item.owner}</td>
                                <td>${item.reference}</td>
                                <td>${item.status}</td>
                                <td>${item.created_at}</td>
                            `;
                            tbody.appendChild(row);
                        });
                    }
                }).catch((error) => {
                    console.error("Error:", error);
                });
            } else {
                alert("search box is empty")
            }

        });
    </script>
    {{-- core js end  --}}
</body>

</html>
