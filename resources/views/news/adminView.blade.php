@include('includes.sub_head')
<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu 2-columns" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    
    @include('includes.sub_header')
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="news-details">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <div class="container">
                                            <div class="row">
                                                <!-- News Content -->
                                                <div class="col-md-6">
                                                    <h3>{{ $news->title ?? 'No title available' }}</h3>
                                                    <p style="color:#ccc">{{ is_array($news->category) ? implode(', ', $news->category) : ($news->category ?? 'No category available') }}</p>
                                                    <p>{{ $news->description ?? 'No description available' }}</p>
                                                </div>
                                                <!-- Carousel for News Images -->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Images</h4>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <div id="news-carousel" class="carousel slide" data-ride="carousel">
                                                                    <ol class="carousel-indicators">
                                                                        @if(is_array($news->image) && count($news->image) > 0)
                                                                            @foreach ($news->image as $index => $image)
                                                                                <li data-target="#news-carousel" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                                                                            @endforeach
                                                                        @else
                                                                            <li data-target="#news-carousel" data-slide-to="0" class="active"></li>
                                                                        @endif
                                                                    </ol>
                                                                    <div class="carousel-inner" role="listbox">
                                                                        @if(is_array($news->image) && count($news->image) > 0)
                                                                            @foreach ($news->image as $index => $image)
                                                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                                    <img src="{{ asset('images/news_images/' . $image) }}" class="img-fluid" alt="Slide {{ $index + 1 }}">
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <div class="carousel-item active">
                                                                                <img src="{{ asset('path_to_default_image/default.jpg') }}" class="img-fluid" alt="Default Slide">
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <a class="carousel-control-prev" href="#news-carousel" role="button" data-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                    <a class="carousel-control-next" href="#news-carousel" role="button" data-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="sr-only">Next</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Carousel -->
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
    <!-- END: Content-->

    @include('includes.sub_footer')
</body>
</html>
