@include('includes.sub_head')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    
    @include('includes.sub_header')
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="tickets">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <!-- Task List table -->
                                        <div class="table-responsive">
                                            <table id="project-task-list" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($news as $update)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ route('news.view', $update->id) }}" class="text-bold-600">{{ $update->title }}</a>
                                                            </td>
                                                            <td>
                                                                <p class="text-muted">{{ Illuminate\Support\Str::limit($update->description, 50, '...') }}</p>
                                                            </td>
                                                            <td>
                                                                <h6>{{ \Carbon\Carbon::parse($update->date)->format('F d, Y') }}</h6>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center">No news updates available.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--/ Task List table -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('includes.sub_footer')
</body>
</html>
