@include('includes.head')

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    


    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Students</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">Students
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- File export table -->
                <section id="file-export">
                    <div class="row">
                        <div class="col-12">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Manage Students</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <table class="table table-striped table-bordered file-export">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Score</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($students as $student)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $eventAttendeesCount[$student->id] }}</td>
                                                    <td><a href="student/delete/{{ $student->id }}" class="delete-student" data-id="{{ $student->id }}"
                                                        onclick="confirmDelete({{ $student->id }})">
                                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                    </a>
                                                    <form id="approveRejectForm" action="" method="POST" style="margin:2px">
                                                        @csrf
                                                        <button type="button" class="btn btn-success btn-sm approve-btn" data-id="">Approve</button>
                                                        <button type="button" class="btn btn-secondary btn-sm reject-btn" data-id="">Reject</button>
                                                        <input type="hidden" id="approvalStatus" name="approval_status">
                                                        <input type="hidden" id="dataId" name="data_id">
                                                    </form>
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Score</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- File export table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Modal -->
    
    @include('includes.footer') 
    <script>
        
        
        $(document).ready(function(){
            $('.delete-student').click(function(event) {
                event.preventDefault(); // Prevent the default action (i.e., following the link)

                var coordinatorId = $(this).data('id'); // Get the coordinator ID from the data attribute

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to the delete route
                        window.location.href = '/students/delete/' + coordinatorId;
                    }
                });
            });
        });
        

        $(document).ready(function() {
            $('.approve-btn').click(function() {
                setApprovalStatus(this, 1);
            });

            $('.reject-btn').click(function() {
                setApprovalStatus(this, 2);
            });
        });


        function setApprovalStatus(button, status) {
            var dataId = $(button).data('id');
            $('#approvalStatus').val(status);
            $('#dataId').val(dataId);
            $('#approveRejectForm').submit();
        }

    </script>
