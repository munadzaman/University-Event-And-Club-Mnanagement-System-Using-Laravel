@include('includes.head')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" dat   a-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    


    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
        <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Event</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="">Events</a>
                                </li>
                                <li class="breadcrumb-item active">Edit
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
                <section id="file-export">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit an Event</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                    <form class="form" action="{{ route('events.update', ['id' => $event->id]) }}" method="post" enctype="multipart/form-data">
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
                                                            <input type="text" name="name" value="{{ $event->name }}" id="projectinput1" class="form-control" placeholder="Full Name" required  >
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
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput3">Venue<span class="text-danger"> *</span></label>
                                                            <input type="text" id="projectinput3" value="{{ $event->venue }}" name="venue" required class="form-control" placeholder="Event Venue">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Starting Date <span class="text-danger"> *</span></label>
                                                            <input type="date" id="projectinput4" value="{{ $event->start_date }}" name="start_date" class="form-control" placeholder="Phone" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">End Date <span class="text-danger"> *</span></label>
                                                            <input type="date" id="projectinput4" value="{{ $event->end_date }}" name="end_date" class="form-control" placeholder="Phone" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Start Time <span class="text-danger"> *</span></label>
                                                            <input type="time" id="projectinput4" value="{{ $event->start_time }}"  name="start_time" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">End Time <span class="text-danger"> *</span></label>
                                                            <input type="time" id="projectinput4" value="{{ $event->end_time }}"  name="end_time" class="form-control" >
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
                                                            <input type="color" id="projectinput4" value="{{ $event->color }}"  name="color" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Description</label>
                                                            <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $event->description }}</textarea>
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
                </section>
                <!-- File export table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('includes.footer')
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/select/form-select2.js"></script>