<!doctype html>
<x-header title="all events" />

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
                                            <h5 class="mb-1 me-2">all events</h5>
                                        </div>
                                        @if (session('message'))
                                            <x-message message="{{ session('message') }}" alert="alert-success" />
                                        @elseif (session('delete'))
                                            <x-message message="{{ session('delete') }}" alert="alert-danger" />
                                        @elseif (session('update'))
                                            <x-message message="{{ session('update') }}" alert="alert-success" />
                                        @endif

                                    </div>
                                    <div class="card-body">
                                        {{--  --}}

                                        <div class="dt-layout-row dt-layout-table">
                                            <div class=" my-4">
                                                <div id="calendar" class="calendar container" style="min-height: 500px;"></div>
                                            </div>
                                            {{-- <div class="dt-layout-cell table-responsive  dt-layout-full">
                                                <table id="basic" class="table dataTable border "
                                                    aria-describedby="basic_info" style="width: 100%;">

                                                    <thead>
                                                        <tr>
                                                            <th data-dt-column="0" rowspan="1" colspan="1"
                                                                class="dt-orderable-asc dt-orderable-desc dt-ordering-asc"
                                                                aria-sort="ascending">Title</th>
                                                            <th data-dt-column="1" rowspan="1" colspan="1"
                                                                class="dt-orderable-asc dt-orderable-desc">Description
                                                            </th>
                                                            <th data-dt-column="1" rowspan="1" colspan="1"
                                                                class="dt-orderable-asc dt-orderable-desc">Start date
                                                            </th>
                                                            <th data-dt-column="1" rowspan="1" colspan="1"
                                                                class="dt-orderable-asc dt-orderable-desc">End date
                                                            </th>

                                                            <th data-dt-column="4" rowspan="1" colspan="1"
                                                                class="dt-orderable-asc dt-orderable-desc"><span
                                                                    class="dt-column-title">Actions</span><span
                                                                    class="dt-column-order" role="button"
                                                                    aria-label="Actions: Activate to sort"
                                                                    tabindex="0"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        @foreach ($events as $event)
                                                            <tr>
                                                                <td class="sorting_1">
                                                                    <i
                                                                        class="icon-base bx bxl-angular icon-md text-danger me-4"></i>
                                                                    <span>{{ $event->title }}</span>
                                                                </td>
                                                                <td> {{ Str::words($event->description, 15, '...') }}
                                                                </td>
                                                                <td> {{ $event->start_date }} </td>
                                                                <td> {{ $event->end_date }}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button id="option" type="button"
                                                                            disabled="disabled"
                                                                            class="btn p-0 option dropdown-toggle hide-arrow"
                                                                            data-bs-toggle="dropdown">
                                                                            <i
                                                                                class="icon-base bx bx-dots-vertical-rounded"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item"
                                                                                href="/admin/event/{{ $event->id }}/edit"><i
                                                                                    class="icon-base bx bx-edit-alt me-1"></i>
                                                                                Edit</a>
                                                                            <form
                                                                                action="/admin/event/{{ $event->id }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button id="delete" type="submit"
                                                                                    class="dropdown-item"><i
                                                                                        class="icon-base bx bx-trash me-1"></i>
                                                                                    Delete</button>
                                                                            </form>

                                                                            <a class="dropdown-item"
                                                                                href="/admin/event/{{ $event->id }}"><i
                                                                                    class="icon-base bx bx-calendar me-1"></i>
                                                                                view</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                    <tfoot></tfoot>
                                                </table>
                                            </div> --}}
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
    <style>
        #calendar {
            min-height: 500px;
            margin: 20px 0;
        }
    </style>
    <script>
        var currentdate = new Date().toISOString().slice(0, 10).replace(/-/g, ":");
        document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: '100%',
                expandRows: true,
                slotMinTime: '08:00',
                slotMaxTime: '20:00',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                initialDate: new Date(),
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                selectable: true,
                nowIndicator: true,
                dayMaxEvents: true, // allow "more" link when too many events  
                events:"/api/events",
                // events: [
                //     {
                //         "title": "Event 1",
                //         "start": "2025-05-01",
                //         "end": "2025-05-02",
                //         "description": "This is a test event"
                //     },
                //     {
                //         "title": "Event 2",
                //         "start": "2025-05-05",
                //         "description": "Another test event"
                //     }
                // ],

                select: function(info) {
                    // Show modal to add event
                    // $('#eventModal').modal('show');
                    // $('#eventStart').val(info.startStr);
                    // $('#eventEnd').val(info.endStr);

                    $('#saveEvent').off().on('click', function() {
                        let title = $('#eventTitle').val();
                        let start = $('#eventStart').val();
                        let end = $('#eventEnd').val();

                        if (title && start) {
                            $.ajax({
                                url: '/events',
                                type: 'POST',
                                data: {
                                    title: title,
                                    start: start,
                                    end: end,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(event) {
                                    calendar.addEvent(event);
                                    $('#eventModal').modal('hide');
                                }
                            });
                        }
                    });
                },
                // eventClick: function(info) {
                //     if (confirm("Do you want to delete this event?")) {
                //         $.ajax({
                //             url: `/events/${info.event.id}`,
                //             type: 'DELETE',
                //             data: {
                //                 _token: '{{ csrf_token() }}'
                //             },
                //             success: function() {
                //                 info.event.remove();
                //             }
                //         });
                //     }
                // }) 
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // don't let the browser navigate
                    // alert('Event: ' + info.event.title);
                    console.log(info.event)
                    console.log(info.event.title)
                    console.log(info.event.url)
                    console.log(info.event.url.length)
                    console.log(info.event.extendedProps.description)
                    new swal({
                        title: info.event.title,
                        icon: "success",
                        text: ` ${info.event.extendedProps.description}`,
                        buttons: true,
                        content: ` <a href='' >url</a> `,
                        dangerMode: true
                    })
                    // swal({
                    //     icon:'success',
                    //     title:info.event.title,
                    //     text: info.event.description,
                    //     //   content: "input",
                    //     // content: "<p>" + info.event.description + "</p> ",
                    //     button: {
                    //         text: "close",
                    //         closeModal: true,
                    //     },
                    // })
                    if (info.event.url.length > 5) {
                        var c= confirm("do you want to open even link")
                        if(c){
                             window.open(info.event.url);
                        }
                       
                    }
                },


            });

            calendar.render();
        });

        // 
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
    
    </script>
    {{-- core js end  --}}
</body>

</html>
