<!doctype html>
<x-header title="edit event" />

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
                                            <h5 class="mb-1 me-2">edit ticket</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form class="row" enctype="multipart/form-data"
                                            action="/admin/ticket/{{ $ticket->id }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="form-floating col-lg-11 m-1">
                                                <input type="text" class="form-control" value="{{ $icket->title }}"
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
                                                    value="{{ $ticket->price }}" id="price" name="price"
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
                                                    value="{{ $ticket->qty }}" id="qty" name="qty"
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
                                                rows="10">{{ $ticket->description }}</textarea>
                                            @error('description')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                            <div class="form-floating col-lg-3 m-1">
                                                <input class="form-control" value="{{ $ticket->start_time}}" type="time" name="start_time" id="start_time">
                                                <label for="start_time">start time</label>
                                                @error('start_time')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-3 m-1">
                                                <input class="form-control" value="{{$ticket->end_time}}" type="time" name="end_time" id="end_time">
                                                <label for="end_time">end time</label>
                                                @error('end_time')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="mb-4  col-lg-4">
                                                <label for="exampleFormControlInput1" class="form-label"> Start
                                                    Date</label>
                                                <input type="date" name="start_date" class="form-control" value="{{ $ticket->start_date }}" id="exampleFormControlInput1"
                                                    placeholder=" 03-06-2025">
                                                @error('start_date')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="mb-4  col-lg-4">
                                                <label for="exampleFormControlInput1" class="form-label"> End
                                                    Date</label>
                                                <input type="date" value="{{ $ticket->end_date }}" name="end_date" class="form-control" id="exampleFormControlInput1"
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
                                                    <option {{ $ticket->event_id==$event->id? "selected": "" }} value="{{$event->id}}">{{ $event->title }}</option>
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
                                                <select required class="form-control" name="ticketType_id" id="ticketType_id">
                                                    @foreach ($ticketTypes as $ticketType )
                                                    <option {{ $ticket->ticketType_id==$ticketType->id? "selected": "" }} value="{{$ticketType->id}}">{{ $ticketType->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="ticketType_id">ticket Type</label>
                                                @error('ticketType_id')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <input class="btn btn-primary m-3" name="update" type="submit"
                                                value="update ticket">
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
    <script>
        const imageEl = document.getElementById("image");
        imageEl.addEventListener("change", function() {
            const file = imageEl.files[0];
            const fileSize = file.size / 1024 / 1024; // in MB
            if (fileSize > 1) {
                alert("File size is too large");
                imageEl.value = "";
            } else {
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
            }

        });
    </script>
</body>

</html>
