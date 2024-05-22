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
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block"></h3>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('clubs.index') }}">
                        <button class="btn btn-info mb-1" type="button">Go Back</button>
                        </a>
                    </div>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card mt-2">
                            <div class="card-header">
                                <h4 class="card-title" style="font-size:30px">{{ $club->name }}</h4>
                                <hr>
                            </div>
                            <div class="card-content">
                                <img class=" img-fluid" src="{{ asset('images/club_logos/' . $club->logo) }}" alt="Card image cap">
                                
                                <div class="card-body">
                                Since {{ $club->created_at->format('M j, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-2">
                        <h2>Description</h2>
                        <p style="font-size:15px">{!! nl2br(e($club->description)) !!}</p>
                        
                        @if($pendingClubs != '' && in_array($club->id, $pendingClubs))
                            <p class="bg-secondary text-center p-1" style="color:#fff">Your request to join the club is pending approval from the admin</p>
                
                        @elseif($rejectedClubs != '' && in_array($club->id, $rejectedClubs))
                        <p class="bg-danger text-center p-1" style="color:#fff">Your request to join the club has been rejected</p>
                        
                        @elseif($clubs != '' && in_array($club->id, $clubs))
                        <p class="bg-success text-center p-1" style="color:#fff">You are Already a Member</p>
                        
                        @else
                        <button class="btn btn-success btn-block" data-id="{{ $club->id }}" id="registerButton">Request For Join {{ $club->name }}</button>
                        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('includes.sub_footer')

    <script>
        $(document).ready(function() {
            $('#registerButton').click(function() {
                const clubId = $(this).data('id');
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
                            url: '/club/register/',
                            method: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                "clubId" : clubId,
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