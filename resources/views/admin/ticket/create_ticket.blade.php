<!doctype html>
<x-header title="create ticket" />

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
                                            <h5 class="mb-1 me-2">Add ticket</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form class="row" enctype="multipart/form-data" action="/admin/ticket/store"
                                            method="post">
                                            @csrf
                                            <div class="form-floating col-lg-11 m-1">
                                                <input type="text" class="form-control" value="{{ old('title') }}"
                                                    id="title" name="title" placeholder="fly down the sky"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="title">Title</label>
                                                @error('title')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div id="price" class="form-floating col-lg-5 m-1">
                                                <input type="number" step="0.1" class="form-control"
                                                    value="{{ old('price') }}" id="price" name="price"
                                                    placeholder="eg 200"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="price">price</label>
                                                @error('price')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div id="qty" class="form-floating col-lg-5 m-1">
                                                <input type="number" step="0.1" class="form-control"
                                                    value="{{ old('qty') }}" id="qty" name="qty"
                                                    placeholder="eg 200"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="qty">quantity</label>
                                                @error('qty')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <textarea placeholder="type ticket description here" class="form-control col-lg-11 m-1" name="description" id="description" cols="30"
                                                rows="10">{{ old("description") }}</textarea>
                                            @error('description')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                            <div class="form-floating col-lg-3 m-1">
                                                <input class="form-control" type="time" name="start_time" id="start_time">
                                                <label for="start_time">start time</label>
                                                @error('start_time')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-3 m-1">
                                                <input class="form-control" type="time" name="end_time" id="end_time">
                                                <label for="end_time">end time</label>
                                                @error('end_time')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="mb-4  col-lg-4">
                                                <label for="start_date" class="form-label"> Start
                                                    Date</label>
                                                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" id="start_date"
                                                    placeholder=" 03-06-2025">
                                                @error('start_date')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="mb-4  col-lg-4">
                                                <label for="end_date" class="form-label"> End
                                                    Date</label>
                                                <input type="date" value="{{ old('end_date') }}" name="end_date" class="form-control" id="end_date"
                                                    placeholder=" 03-06-2025">
                                                @error('end_date')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-4 mb-3">
                                                <select required class="form-control" name="event_id" id="event_id">
                                                    @foreach ($events as $event )
                                                    <option value="{{$event->id}}">{{ $event->title }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="event_id">event</label>
                                                @error('event_id')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-4 mb-3">
                                                <select required class="form-control" name="ticket_type_id" id="ticket_type_id">
                                                    @foreach ($ticketTypes as $ticketType )
                                                    <option value="{{$ticketType->id}}">{{ $ticketType->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="ticket_type_id">ticket Type</label>
                                                @error('ticket_type_id')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <input class="btn btn-primary m-3" name="create_ticket" type="submit"
                                                value="create ticket">
                                        </form>
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
</body>
<script>
    const imageEl = document.getElementById("image");
    imageEl.addEventListener("change", function() {
        const file = imageEl.files[0];
        const fileSize = file.size / 1024 / 1024; // in MB
        if (fileSize > 1) {
            alert("File size is too large");
            imageEl.value = "";
        }
        if (file) {
            const url = URL.createObjectURL(file); // Corrected to use 'URL' instead of 'Url'
            const imageBox = document.getElementById("image-box");
            const newImageEl = document.createElement("img");
            newImageEl.src = url;
            newImageEl.style.width = "150px";
            newImageEl.style.height = "150px";
            imageBox.appendChild(newImageEl);
            // imageBox.style.display = "flex";
        }
    });
</script>

</html>