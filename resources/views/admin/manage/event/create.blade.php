@extends('admin.layout')

@section('events-manage-selected')
    selected
@endsection

@section('events-manage-link-active')
    active
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Create Event</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}"
                                        class="text-muted">Events</a>
                                </li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Create Event</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- basic table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required
                                        placeholder="Event Title">
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="text" class="form-control" id="date" name="date"
                                        placeholder="Event Date">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" required placeholder="Event Description"
                                        rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="btnName">Button Name</label>
                                    <input type="text" class="form-control" id="btnName" name="btn_name"
                                        placeholder="Event Action Button Name">
                                </div>
                                <div class="form-group">
                                    <label for="btnUrl">Button URL</label>
                                    <input type="text" class="form-control" id="btnUrl" name="btn_url"
                                        placeholder="Event Action Button URL">
                                </div>
                                <div class="form-group">
                                    <label for="eventFeaturedImage">Featured Image</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="eventFeaturedImage"
                                                name="featured_image">
                                            <label class="custom-file-label" for="eventFeaturedImage">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex mt-4 gap-15x">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a href="{{ route('admin.event.index') }}" class="btn btn-light">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection
