@include('includes.head')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
<!-- BEGIN: Body-->

    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" dat   a-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    


    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Events</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="">Events</a>
                                </li>
                                <li class="breadcrumb-item active">Add
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('events.index') }}">
                        <button class="btn btn-info mb-1" type="button">Manage Events</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- File export table -->
                <!-- <section id="file-export">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add a New Event</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                    <form class="form" action="{{ route('events.add') }}" method="post" enctype="multipart/form-data">
                                            @csrf

                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            @if (session()->has('success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('success') }}
                                                </div>
                                            @endif
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="name" value="{{ old('name') }}" id="projectinput1" class="form-control" placeholder="Full Name" required  >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Associated Club<span class="text-danger">*</span></label>
                                                            <div class="form-group">
                                                                <select class="select2 form-control" id="select2" name="club_id">
                                                                    <optgroup label="Clubs">
                                                                        @foreach($clubs as $club)
                                                                            <option value="{{ $club->id }}">
                                                                                <img src="{{ asset('images/club_logos/' . $club->logo) }}" alt="{{ $club->name }}" style="width: 30px; height: 30px; margin-right: 5px;">
                                                                                {{ $club->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" value="{{ Auth::user()->id }}" hidden name="coordinator_id">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput3">Venue<span class="text-danger"> *</span></label>
                                                            <input type="text" id="projectinput3" value="{{ old('venue') }}" name="venue" required class="form-control" placeholder="Event Venue">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Starting Date <span class="text-danger"> *</span></label>
                                                            <input type="date" id="projectinput4" value="{{ old('start_date') }}" name="start_date" class="form-control" placeholder="Phone" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">End Date <span class="text-danger"> *</span></label>
                                                            <input type="date" id="projectinput4" value="{{ old('end_date') }}" name="end_date" class="form-control" placeholder="Phone" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Start Time <span class="text-danger"> *</span></label>
                                                            <input type="time" id="projectinput4" value="{{ old('start_time') }}"  name="start_time" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">End Time <span class="text-danger"> *</span></label>
                                                            <input type="time" id="projectinput4" value="{{ old('end_time') }}"  name="end_time" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Image <span class="text-danger"> *</span></label>
                                                            <input type="file" id="projectinput4" value=""  name="image" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Color <span class="text-danger"> *</span></label>
                                                            <input type="color" id="projectinput4" value="#5059e5"  name="color" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Description</label>
                                                            <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ old('description') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <a href="index.php">
                                                        <button type="button" class="btn btn-warning mr-1">
                                                            <i class="ft-x"></i> Cancel
                                                        </button>
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> Save
                                                    </button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> -->
                <!-- File export table -->

                <!-- Form wizard with number tabs section start -->
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form action="{{ route('events.update', ['id' => $event->id]) }}" id="stepForm" method="post" enctype="multipart/form-data" class="number-tab-steps wizard-circle">
                                            <!-- Step 1 -->
                                            <h6>Event Info</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="name" value="{{ $event->name }}" id="projectinput1" class="form-control" placeholder="Full Name" required  >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Associated Club<span class="text-danger">*</span></label>
                                                            <div class="form-group">
                                                                <select class="select2 form-control" id="select2" name="club_id">    
                                                                    @foreach($clubs as $club)
                                                                        <option value="{{ $club->id }}" @if($club->id == $event->club_id) selected @endif >{{ $club->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" value="{{ Auth::user()->id }}" hidden name="coordinator_id">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput3">Venue<span class="text-danger"> *</span></label>
                                                            <input type="text" id="projectinput3" value="{{ $event->venue }}" name="venue" required class="form-control" placeholder="Event Venue" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Starting Date <span class="text-danger"> *</span></label>
                                                            <input type="date" id="projectinput4" value="{{ $event->start_date }}" name="start_date" class="form-control" placeholder="Phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">End Date <span class="text-danger"> *</span></label>
                                                            <input type="date" id="projectinput4" value="{{ $event->end_date }}" name="end_date" class="form-control" placeholder="Phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Start Time <span class="text-danger"> *</span></label>
                                                            <input type="time" id="projectinput4" value="{{ $event->start_time }}"  name="start_time" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">End Time <span class="text-danger"> *</span></label>
                                                            <input type="time" id="projectinput4" value="{{ $event->end_time }}"  name="end_time" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Image <span class="text-danger"> *</span></label>
                                                            <input type="file" id="projectinput4" value=""  name="image" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Color <span class="text-danger"> *</span></label>
                                                            <input type="color" id="projectinput4" value="{{ $event->color }}"  name="color" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Description</label>
                                                            <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $event->description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <h6>Visibility</h6>
                                            <fieldset>
                                                <table class="table table-striped table-bordered file-export">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" checked id="selectAllCheckbox">
                                                            </th>
                                                            <th>S.No</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($students as $student)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" checked data-id="{{ $student->id }}">
                                                            </td>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $student->name }}</td>
                                                            <td>{{ $student->email }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>S.No</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with number tabs section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('includes.footer')
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="../../../app-assets/js/scripts/forms/wizard-steps.js"></script>


    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>

    <script src="../../../app-assets/js/scripts/tables/datatables-extensions/datatable-select.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the "Select All" checkbox
        var selectAllCheckbox = document.getElementById("selectAllCheckbox");

        // Get all checkboxes in the table body
        var checkboxes = document.querySelectorAll("tbody input[type='checkbox']");

        // Add a click event listener to the "Select All" checkbox
        selectAllCheckbox.addEventListener("click", function() {
            // Loop through each checkbox in the table body
            checkboxes.forEach(function(checkbox) {
                // Set the checked state of each checkbox to match the "Select All" checkbox
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Update checkboxes based on backend data
        var selectedIds = "{!! $event->visible_to !!}";
        // Split the comma-separated values into an array of IDs
        var selectedIdsArray = selectedIds.split(',');
        checkboxes.forEach(function(checkbox) {
            // Check if the student ID is in the list of selected IDs
            if (selectedIdsArray.includes(checkbox.getAttribute('data-id'))) {
                checkbox.checked = true;
            }
        });
    }); 
</script>


