@include('includes.sub_head')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    
@include('includes.sub_header')
    

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
        <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Calendar Events</h3>
                </div>
            </div>
            <div class="content-body">
                <!-- Full calendar events example section start -->
                <section id="events-examples">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Background Events</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div id='fc-bg-events'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Full calendar events example section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
    
@include('includes.sub_footer')

<script>
    $(document).ready(function(){
        $('.registerButton').click(function() {
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