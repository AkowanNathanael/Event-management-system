<!doctype html>
<x-header title="{{ 'profile' }}" />

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
                                            <h5 class="mb-1 me-2"> @auth
                                               {{  auth()->user()->name }}/'s Profile
                                            @endauth  </h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                         @if ( session("message"))
                                            <x-message message="{{ session('message') }}" alert="alert-success" />
                                        @elseif (session("password_error"))
                                             <x-message message="{{ session('password_error') }}" alert="alert-danger" />
                                        @endif
                                        <div
                                            class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                            <img src="{{ auth()->user()->image? asset('storage/'.auth()->user()->image) : asset('no-image.png')  }}" alt="user-avatar"
                                                class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                            <form action="/auth/profilechange" enctype="multipart/form-data" method="post">
                                                @csrf
                                                @method('post')
                                                <div class="button-wrapper">
                                                <input required class="form-control" max="1048" type="file" id="image" class="account-file-input"
                                                         name="image" accept="image/png, image/jpeg">
                                                <button type="submit" for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                                    <span class="d-none d-sm-block">Upload new photo</span>
                                                    <i class="icon-base bx bx-upload d-block d-sm-none"></i>
                                                </button>
                                                {{-- <button type="button"
                                                    class="btn btn-outline-secondary account-image-reset mb-4">
                                                    <i class="icon-base bx bx-reset d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Reset</span>
                                                </button> --}}

                                                <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="m-2 p-2 shadow shadow-md">
                                        <form action="/auth/changepassword" method="post">
                                            @csrf
                                            @method('post')
                                            @error("credentials")
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="question_text">Name</label>
                                                <input required disabled class="form-control" type="text" name="name" value="{{auth()->user()->name }}"
                                                    id="name" />
                                            </div>
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="question_text">Email</label>
                                                <input placeholder="" required class="form-control" type="email"
                                                    name="email" id="email" value="{{ auth()->user()->email}}" disabled />
                                            </div>
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="oldpassword">Old Password</label>
                                                <input placeholder="enter old password" required class="form-control" type="password"
                                                    name="oldpassword" id="oldpassword" />
                                            </div>
                                             @error("oldpassword")
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="newpassword">New Password</label>
                                                <input placeholder="enter new password" required class="form-control" type="password"
                                                    name="newpassword" id="newpassword" />
                                            </div>
                                              @error("newpassword")
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="newpassword_confirmation">Confirm password</label>
                                                <input placeholder="confirm password" class="form-control" type="password"
                                                    name="newpassword_confirmation" id="newpassword_confirmation" />
                                            </div>
                                            @error("newpassword_confirmation")
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                            <input type="submit" class="m-2 btn btn-primary" value="change password"
                                                name="Confirmpassword" id="Confirmpassword">
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
    </script>
</body>

</html>
