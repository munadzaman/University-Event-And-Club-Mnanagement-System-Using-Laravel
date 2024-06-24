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
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <div class="container">
                                            <div class="tab-content">
                                                <div>
                                                    <h3>{{ $news->title }}</h3>
                                                    <p style="color:#ccc">{{ $news->category }}</p>
                                                    <p>
                                                       {{ $news->description }} 
                                                    </p>
                                                </div>
                                            </div>
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
