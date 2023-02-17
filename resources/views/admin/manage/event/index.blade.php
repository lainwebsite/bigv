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
                <div class="col-5 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Event List</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Events</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-7 align-self-center d-flex justify-content-end align-items-center">
                    <p class="mr-4 mb-0">Sort By</p>
                    <div class="customize-input float-right mr-4">
                        <select id="sort"
                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            <option value="1" selected>Newest</option>
                            <option value="2">Oldest</option>
                        </select>
                    </div>
                    <a class="btn btn-primary text-white pr-4 pl-4" href="{{ route('admin.event.create') }}">
                        Create Event</a>
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
            <div class="d-flex mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchName" name="search_name"
                        placeholder="Search here..">
                    <div class="input-group-append">
                        <div style="border-radius: 0 10px 10px 0 !important;" onclick="searchData()"
                            class="btn btn-outline-secondary border-lightgray">Search</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" id="event-list">
                        @include('admin.manage.event.inc.event')
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

@section('javascript-extra')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>
    <script>
        var page = 1;
        var metric = "created_at";
        var sorted = "desc";
        var search = null;
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            page = $(this).attr('href').split('page=')[1];
            sort(page);
        });
    </script>
    <script>
        function searchData() {
            page = 1;
            search = $("#searchName").val();
            sort(page);
        }
    </script>
    <script>
        $('#sort').on('change', function() {
            page = 1;
            switch ($('#sort').val()) {
                case "1":
                    metric = "created_at";
                    sorted = "desc";
                    break;
                case "2":
                    metric = "created_at";
                    sorted = "asc";
                    break;
                default:
                    break;
            }
            sort(page);
        });
    </script>
    <script>
        function sort(page) {
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + "/admin/event/sort?page=" + page, {
                    _token: CSRF_TOKEN,
                    sort: sorted,
                    metric: metric,
                    search: search
                })
                .done(function(data) {
                    $('#event-list').html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        }
    </script>
    <script>
        function deleteData(id, name) {
            event.preventDefault();
            if (confirm(`Are you sure you want to delete ${name}?`)) {
                document.getElementById(`delete-event-form-${id}`).submit();
            }
        }
    </script>
@endsection
