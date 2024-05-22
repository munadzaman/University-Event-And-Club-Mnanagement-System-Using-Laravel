@include('includes.sub_head')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    
@include('includes.sub_header')
    

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <!-- Simple User Cards with Border-->
            <div class="content-body">
                <section id="tickets">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <!-- <div class="card-header"> -->
                                    <!-- <h2 class="card-title">Explore the Event</h2> -->
                                <!-- </div> -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="media-list media-bordered">
                                                <div class="time mb-3">
                                                    <h1>{{ $event->name }}</h1>
                                                </div>
                                                <table class="table table">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"><h4>Associated Club</h4></th>
                                                            <td><h4>{{ $event->club->name }}</h4></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><h4>Start Date</h4></th>
                                                            <td><h4>{{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}
                                                    | {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</h4></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><h4>End Date</h4></th>
                                                            <td><h4>{{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}
                                                    | {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}</h4></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><h4>Venue</h4></th>
                                                            <td><h4>{{ $event->venue }}</h4></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><h4>No. of Attendees</h4></th>
                                                            <td><h4></h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @if($eventAttendees)
                                                    <p class="text-warning">You are registered for this event</p>
                                                @else
                                                    <button class="btn btn-success" data-id="{{ $event->id }}" id="registerButton">Attend Event</button>
                                                @endif
                                                <h3>Description</h3>
                                                <p>{{ $event->description }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{ asset('images/event_images/' . $event->image) }}" class="img-responsive img-fluid rounded" alt="sd">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
    @include('includes.sub_footer')

    <script>
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
    </script>