@include('includes.head')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    
@include('includes.header')
    
<style>
    .tabs {
    margin-top: 20px;
}

.tab-buttons {
    display: flex;
}

.tab-btn {
    padding: 10px 20px;
    border: none;
    background-color: #f0f0f0;
    cursor: pointer;
    transition: background-color 0.3s;
}

.tab-btn.active {
    background-color: #ccc;
}

.tab-content .tab {
    display: none;
    padding: 10px;
}

.tab-content .tab.active {
    display: block;
}

</style>

    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Event</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">Event 
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('events.add') }}">
                            <button class="btn btn-info mb-1" type="button">Manage Events</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <!-- Road Trip Card -->

                    <div class="card">
                        <!-- <a href="#"><img src="{{ asset('images/event_images/' . $event->image) }}" height="200" alt="" class=""></a> -->
                        <div class="card-body">
                            <div class="row mb-1 tabs">
                                <div class="col-md-2 mb-1 tab-buttons">
                                    <button class="btn tab-btn btn-secondary active" style="width: 150px;" data-tab="#event_info">Event Info </button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn tab-btn btn-outline-secondary" style="width: 150px;" data-tab="#event_attendees">Event Attendees</button>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab active" id="event_info">
                                    <div class="row">
                                        <div class="col-lg-6 col-6">
                                        <h1 class="mb-1">{{ $event->name }}</h1>
                                    
                                        <div style="display: flex; align-items: center;" class="mt-1">
                                            <a href="#" type="button" data-toggle="modal" data-target="#iconModal" onclick="setModalImage('{{ asset('images/event_images/' . $event->image) }}', '{{ $event->name }}')" style="margin-right: 10px;">
                                                <img src="{{ asset('images/event_images/' . $event->image) }}" class="rounded-circle img-thumbnail" style="width: 30px; height: 30px;">
                                            </a>
                                            <h6 class="card-subtitle text-muted" style="margin: 0;">{{ $event->club->name }}</h6>
                                        </div>
                                        <div style="display: flex; align-items: center;">
                                                <i class="la la-map-pin mt-1" style="font-size: 25px;"></i>
                                                <span style="margin-top: 10px;margin-left:10px; vertical-align: middle;">{{ $event->venue }}</span>
                                            </div>
                                            <div style="display: flex; align-items: center;">
                                                <i class="la la-clock-o mt-1" style="font-size: 25px;"></i>
                                                <span style="margin-top: 10px; margin-left: 10px; vertical-align: middle;">
                                                    {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}
                                                    | {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}
                                                </span>
                                                <span style="margin-top: 10px; margin-left: 10px; vertical-align: middle; ">TO</span>
                                                <span style="margin-top: 10px; margin-left: 10px; vertical-align: middle;">
                                                    {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}
                                                    | {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                                                </span>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-6">
                                            <div class="col-lg-6 col-6">
                                                <img class="img-fluid" src="{{ asset('images/event_images/' . $event->image) }}" style="width: 100%; height: 200px; object-fit: cover;" alt="Card image cap">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-6">
                                            <h2 class="mt-2">Description: </h2>
                                            <p style="font-size:18px">{{ $event->description }}</p>
                                        </div>
                                        <div class="col-lg-6 col-6 mt-4">
                                            @if(Auth::user()->role == 'student')
                                                @if ($isAttending)
                                                <span class="bg-success p-1 rounded text-dark">You are Already Registered <i class="la la-check-circle"></i></span>
                                                @else
                                                <button id="registerButton" data-id="{{ $event->id }}" class="btn btn-outline-success">Register Yourself</button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" id="event_attendees">
                                    <table class="table table-striped table-bordered file-export" id="attendeeTable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($attendees as $attendee)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $attendee->name }}</td>
                                                    <td>{{ $attendee->email }}</td>
                                                </tr>
                                            @endforeach

                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    @include('includes.footer') 
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/select/form-select2.js"></script>

    <script>
        $(document).ready(function() {
            $('#registerButton').click(function() {
                const eventId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Register Me'
                }).then((result) => {
                if (result.value) {
                        $.ajax({
                            url: '/event/register/',
                            method: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                "eventId" : eventId,
                            },
                            success: function(response) {
                                    Swal.fire(
                                        'Registered',
                                        'Registered Successfully',
                                        'success'
                                    ).then(function () {
                                        location.reload();
                                    })
                            },
                        });
                    }
                })
            });
            $('.tab-btn').on('click', function() {
                var tabId = $(this).data('tab');

                // Remove 'active' class from all buttons and add 'btn-outline-secondary' class
                $('.tab-btn').removeClass('active btn-secondary').addClass('btn-outline-secondary');

                // Add 'active' class to the clicked button and change its style
                $(this).addClass('active btn-secondary').removeClass('btn-outline-secondary');

                // Show/Hide Tabs
                $('.tab-content ' + tabId).show().siblings().hide();
            });
        });
        
    </script>