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
                <section id="simple-user-cards-with-border" class="row mt-2">
                    <div class="col-12">
                            <h4 class="text-uppercase">My Clubs</h4>
                            <p>Clubs You've Joined.</p>
                    </div>
                    @foreach($clubs as $myClub)
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card border-teal border-lighten-2">
                                <div class="text-center">
                                    <div class="card-body">
                                        <img src="{{ asset('images/club_logos/' . $myClub->logo) }}" class="rounded-circle  height-150 img-responsive" alt="Card image">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $myClub->name }}</h4>
                                        <h6 class="card-subtitle text-muted">{{ $myClub->created_at->format('M j, Y') }}</h6>
                                    </div>
                                    <div class="text-center">
                                        <a href="clubs/view/{{ $myClub->id }}"  class="btn mb-1 btn-outline-facebook">View Details</span></a>
                                        @if($pendingClubs != '' && in_array($myClub->id, $pendingClubs))
                                            <p class="btn mb-1 btn-secondary">Request Pending</span></p>
                                        @elseif($rejectedClubs != '' && in_array($myClub->id, $rejectedClubs))
                                            <p class="btn mb-1 btn-danger">Rejected</span></p>
                                        @elseif($clubs != '' && in_array($myClub->id, $approvedClubs))
                                            <button class="btn mb-1 btn-success">Member</span></button>
                                        @else
                                        <button id="registerButton" data-id="{{ $myClub->id }}" class="btn mb-1 btn-info">Request Join</span></button>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>  
            </div>
        </div>
    </div>
    
@include('includes.sub_footer')

<script>
    $(document).ready(function(){
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
    });
</script>