@include('includes.head')

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    @include('includes.sidemenu')
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit News</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a></li>
                                <li class="breadcrumb-item active"><a href="">News</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('news.index') }}">
                            <button class="btn btn-info mb-1" type="button">Manage News</button>
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
                                    <h4 class="card-title">Edit News</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <form class="form" action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
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
                                                            <label for="title">Title <span class="text-danger">*</span></label>
                                                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $news->title) }}" required placeholder="News Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="date">Date <span class="text-danger">*</span></label>
                                                            <input type="date" id="date" name="date" class="form-control" value="{{ old('date', $news->date) }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="category">Category <span class="text-danger">*</span></label>
                                                            <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $news->category) }}" required placeholder="Enter Category">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="image">Images</label>
                                                            <input type="file" id="image" name="image[]" class="form-control" multiple>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea name="description" class="form-control" id="description" cols="30" rows="10" placeholder="Enter description here....">{{ old('description', $news->description) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <a href="{{ route('news.index') }}">
                                                        <button type="button" class="btn btn-warning mr-1">
                                                            <i class="ft-x"></i> Cancel
                                                        </button>
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> Save
                                                    </button>
                                                </div>
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
</body>
</html>
