@include('includes.sub_head')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    
@include('includes.sub_header')
    

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Statistics with grouped cards -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $clubCount }}</h1>
                                            <span>Total Clubs</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $pendingClubsCount }}</h1>
                                            <span>Requested Clubs</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $rejectedClubsCount }}</h1>
                                            <span>Rejected Clubs</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $approvedclubsCount }}</h1>
                                            <span>Approved Clubs</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $upcomingStudentEvents }}</h1>
                                            <span>Total Events</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $studentScore }}</h1>
                                            <span>Attended Events</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $studentScore }}</h1>
                                            <span>Total Score</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $upcomingEvents }}</h1>
                                            <span>Upcoming Events</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MONTHLY ANALYTICS -->
                <!-- <div class="row match-height">
                    <div class="col-12" id="ecommerceChartView">
                        <div class="card card-shadow">
                            <div class="card-header card-header-transparent py-20">
                                <div class="btn-group dropdown">
                                    <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">MONTHLY
                                        ANALYTICS</a>
                                    <div class="dropdown-menu animate" role="menu">
                                        <a class="dropdown-item" href="#" role="menuitem">Sales</a>
                                        <a class="dropdown-item" href="#" role="menuitem">Total sales</a>
                                        <a class="dropdown-item" href="#" role="menuitem">profit</a>
                                    </div>
                                </div>
                                <ul class="nav nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                                    <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">New
                                            Tickets</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Agent Responses</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Response Time</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToDay">Closed Tickets</a></li>
                                </ul>
                            </div>
                            <div class="widget-content tab-content bg-white p-20">
                                <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay"></div>
                                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToWeek"></div>
                                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToMonth"></div>
                                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToDay1"></div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Payment Methods & Purchase History -->
                <!-- <div class="row match-height">
                    <div class="col-md-6">
                        <div class="card payment">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Support Payment Methods</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-2">
                                            <img class="" src="../../../app-assets/images/icons/card-1.png" alt="avatar" width="50">
                                        </div>
                                        <div class="col-8">
                                            <h6>REDQTEAM-XXX-5994</h6>
                                            <p>EX 04/2022</p>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-sm btn-icon btn-danger mr-1"><i class="ft-x"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-2">
                                            <img class="" src="../../../app-assets/images/icons/card-2.png" alt="avatar" width="50">
                                        </div>
                                        <div class="col-8">
                                            <h6>REDQTEAM-XXX-5834</h6>
                                            <p>EX 12/2020</p>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-sm btn-icon btn-danger mr-1"><i class="ft-x"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Purchase History</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-2">
                                            <img class="" src="../../../app-assets/images/icons/mail-chimp.png" alt="avatar" width="50">
                                        </div>
                                        <div class="col-7">
                                            <h6>MailChilp <span>- Singles site</span></h6>
                                            <p>$35.00 - excludes 0% tax</p>
                                        </div>
                                        <div class="col-3">
                                            <p class="m-0">05-10-2018</p>
                                            <p class="info">invoice</p>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-2">
                                            <img class="" src="../../../app-assets/images/icons/google.png" alt="avatar" width="50">
                                        </div>
                                        <div class="col-7">
                                            <h6>MailChilp <span>- Singles site</span></h6>
                                            <p>$35.00 - excludes 0% tax</p>
                                        </div>
                                        <div class="col-3">
                                            <p class="m-0">05-10-2018</p>
                                            <p class="info">invoice</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Your Open Tickets & Ticket Categories -->
                

            </div>
        </div>
    </div>
    
    @include('includes.sub_footer')