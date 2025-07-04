<!doctype html>
<x-header title="create event" />

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
                                            <h5 class="mb-1 me-2">Add Event</h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form class="row" enctype="multipart/form-data" action="/admin/event/store"
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
                                            <div id="image-box" class="form-floating col-lg-11 m-1">
                                                <input type="file" accept="image/*" class="form-control"
                                                    value="{{ old('image') }}" id="image" name="image"
                                                    placeholder="fly down the sky"
                                                    aria-describedby="floatingInputHelp" />
                                                <label for="image">Image</label>
                                                @error('image')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <textarea placeholder="type event description here" class="form-control col-lg-11 m-1" name="description" id="description" cols="30"
                                                rows="10">{{ old("description") }}</textarea>
                                            @error('description')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                            <div class="form-floating col-lg-3 m-1">
                                                <select class="form-control" name="status" id="status">
                                                    <option value="upcoming">upcoming</option>
                                                    <option value="ongoing">ongoing</option>
                                                    <option value="completed">completed</option>
                                                    <option value="cancelled">cancelled</option>
                                                </select>
                                                <label for="status">status</label>
                                                @error('status')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="mb-4  col-lg-4">
                                                <label for="exampleFormControlInput1" class="form-label"> Start
                                                    Date</label>
                                                <input type="date" name="start" class="form-control" value="{{ old('start') }}" id="exampleFormControlInput1"
                                                    placeholder=" 03-06-2025">
                                                @error('start')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="mb-4  col-lg-4">
                                                <label for="exampleFormControlInput1" class="form-label"> End
                                                    Date</label>
                                                <input type="date" value="{{ old('end') }}" name="end" class="form-control" id="exampleFormControlInput1"
                                                    placeholder=" 03-06-2025">
                                                @error('end')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-4 mb-3">
                                                <select required class="form-control" name="category_id" id="category_id">
                                                    @foreach ($categories as $category )
                                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="category">category</label>
                                                @error('category')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-4 mb-3">
                                                <select required class="form-control" name="venue_id" id="venue_id">
                                                    @foreach ($venues as $venue )
                                                    <option value="{{$venue->id}}">{{ $venue->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="venue_id">venue</label>
                                                @error('venue_id')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="form-floating col-lg-4 mb-3">
                                                <select required class="form-control" name="organiser_id" id="organiser_id">
                                                    @foreach ($organisers as $organiser )
                                                    <option value="{{$organiser->id}}">{{ $organiser->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="organiser_id">organiser</label>
                                                @error('organiser_id')
                                                <p id="floatingInputHelp" class="form-text text-danger ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <input class="btn btn-primary m-3" name="submit" type="submit"
                                                value="add event">
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
