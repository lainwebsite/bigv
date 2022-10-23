@extends('admin.layout')

@section('vendors-analytics-selected')
selected
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
            <div class="col-6 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Vendor Analytics</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Vendor Analytics</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-6 align-self-center d-flex justify-content-end align-items-center">
                <div class="card-not-selected border-lightgray pl-4 pb-2 pt-2 pr-4 rounded-pill mb-2" id="expandFilter">
                    <div class="d-flex align-items-center justify-content-between" style="gap: 10px;">
                        <i class="fa fa-filter"></i>
                        <p class="m-0">Filter</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3" id="expandableFilter" style="display:none;">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label><b>Date</b></label>
                                <div class="align-self-center mb-3 d-flex align-items-center flex-wrap">
                                    <input type="date" class="form-control w-auto" value="2018-05-13">
                                    <p class="ml-3 mr-3 mb-0">-</p>
                                    <input type="date" class="form-control w-auto mr-4" value="2018-05-13">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2 gap-15x">
                            <button id="btnApplyVoucher" class="btn btn-primary">Apply</button>
                        </div>
                    </div>
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
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Top 5 Vendors Sales</h4>
                        <ul class="list-inline text-right">
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-purple"></i>Vendor 1</h5>
                            </li>
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-cyan"></i>Vendor 2</h5>
                            </li>
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-dark"></i>Vendor 3</h5>
                            </li>
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-orange"></i>Vendor 4</h5>
                            </li>
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-danger"></i>Vendor 5</h5>
                            </li>
                        </ul>
                        <div id="vendor-sales"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Top 5 Vendors Income</h4>
                        <ul class="list-inline text-right">
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-purple"></i>Vendor 1</h5>
                            </li>
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-cyan"></i>Vendor 2</h5>
                            </li>
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-dark"></i>Vendor 3</h5>
                            </li>
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-orange"></i>Vendor 4</h5>
                            </li>
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-danger"></i>Vendor 5</h5>
                            </li>
                        </ul>
                        <div id="vendor-income"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                                <h4 class="card-title m-0">Products Analytics of the Specified Dates</h4>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex justify-content-end">
                                <div class="d-flex align-items-center">
                                    <p class="mr-4 mb-0">Sort By</p>
                                    <div class="customize-input float-right mr-4">
                                        <select class="custom-select rounded-pill custom-select-set form-control bg-white custom-shadow custom-radius">
                                            <option value="1" selected="">Number of Transaction</option>
                                            <option value="2">Sold</option>
                                            <option value="3">Total Income</option>
                                            <option value="4">Rating</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Vendor</th>
                                        <th>Number of Transaction</th>
                                        <th>Total Income</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 1; $i < 9; $i++)
                                    <tr>
                                        <td class="align-middle">{{$i}}</td>
                                        <td>
                                            <a href="{{url('/vendor-analytics/detail')}}" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2022/08/Plant-Resident-300x286.jpg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Plant Resident</b></h5>
                                                    <small class="m-0">North</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">$128</td>
                                        <!-- Rating average dari semua product (all time) -->
                                        <td class="align-middle">4.5</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12 h-100">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Vendors Information</h4>
                        <h5>Total Number of Vendors</h5>
                        <h3 class="text-orange"><b>40</b></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Abandoned Cart</h4>
                        <div id="abandoned-cart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection

@section('javascript-extra')
<script>
    var filterOpened = false;
    $("#expandFilter").on("click", function() {
        if (filterOpened) {
            $("#expandableFilter").slideUp();
            filterOpened = false;
        } else {
            $("#expandableFilter").slideDown();
            filterOpened = true;
        }
    });

    $("#btnApplyVoucher").on("click", function(){
        $("#expandFilter").click();
    });
</script>
<script src="{{asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>
<script src="{{asset('assets/libs/morris.js/morris.min.js')}}"></script>
<script src="{{asset('assets/libs/chart.js/dist/Chart.min.js')}}"></script>
<script>
    $(function() {
        "use strict";
        Morris.Area({
            element: 'vendor-sales',
            data: [{
                    period: '2022-04-12',
                    vendor1: 50,
                    vendor2: 120,
                    vendor3: 80,
                    vendor4: 68,
                    vendor5: 97,
                    itouch: 20
                }, {
                    period: '2022-04-13',
                    vendor1: 83,
                    vendor2: 98,
                    vendor3: 61,
                    vendor4: 59,
                    vendor5: 101,
                    itouch: 80
                }, {
                    period: '2022-04-14',
                    vendor1: 50,
                    vendor2: 120,
                    vendor3: 80,
                    vendor4: 68,
                    vendor5: 97,
                    itouch: 70
                }, {
                    period: '2022-04-15',
                    vendor1: 80,
                    vendor2: 70,
                    vendor3: 105,
                    vendor4: 150,
                    vendor5: 80,
                    itouch: 140
                }, {
                    period: '2022-04-16',
                    vendor1: 50,
                    vendor2: 120,
                    vendor3: 80,
                    vendor4: 68,
                    vendor5: 97,
                    itouch: 140
                }, {
                    period: '2022-04-17',
                    vendor1: 80,
                    vendor2: 120,
                    vendor3: 40,
                    vendor4: 80,
                    vendor5: 70,
                    itouch: 80
                },
                {
                    period: '2022-04-18',
                    vendor1: 100,
                    vendor2: 70,
                    vendor3: 40,
                    vendor4: 98,
                    vendor5: 77,
                    itouch: 200
                }
            ],
            xkey: 'period',
            ykeys: ['vendor1', 'vendor2', 'vendor3', 'vendor4', 'vendor5'],
            labels: ['Vendor 1', 'Vendor 2', 'Vendor 3', 'Vendor 4', 'Vendor 5'],
            xLabels: 'day',
            xLabelFormat: function(x) {
                return x.getDate() + "/" + (x.getMonth() + 1).toString().padStart(2, '0')
            },
            pointSize: 3,
            fillOpacity: 0,
            pointStrokeColors: ['#5f76e8', "#01caf1", "#1c2d41", "#fb8c00", "#ff4f70"],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#5f76e8', "#01caf1", "#1c2d41", "#fb8c00", "#ff4f70"],
            resize: true,
        });

        Morris.Area({
            element: 'vendor-income',
            data: [{
                    period: '2022-04-12',
                    vendor1: 50,
                    vendor2: 120,
                    vendor3: 80,
                    vendor4: 68,
                    vendor5: 97,
                    itouch: 20
                }, {
                    period: '2022-04-13',
                    vendor1: 83,
                    vendor2: 98,
                    vendor3: 61,
                    vendor4: 59,
                    vendor5: 101,
                    itouch: 80
                }, {
                    period: '2022-04-14',
                    vendor1: 50,
                    vendor2: 120,
                    vendor3: 80,
                    vendor4: 68,
                    vendor5: 97,
                    itouch: 70
                }, {
                    period: '2022-04-15',
                    vendor1: 80,
                    vendor2: 70,
                    vendor3: 105,
                    vendor4: 150,
                    vendor5: 80,
                    itouch: 140
                }, {
                    period: '2022-04-16',
                    vendor1: 50,
                    vendor2: 120,
                    vendor3: 80,
                    vendor4: 68,
                    vendor5: 97,
                    itouch: 140
                }, {
                    period: '2022-04-17',
                    vendor1: 80,
                    vendor2: 120,
                    vendor3: 40,
                    vendor4: 80,
                    vendor5: 70,
                    itouch: 80
                },
                {
                    period: '2022-04-18',
                    vendor1: 100,
                    vendor2: 70,
                    vendor3: 40,
                    vendor4: 98,
                    vendor5: 77,
                    itouch: 200
                }
            ],
            xkey: 'period',
            ykeys: ['vendor1', 'vendor2', 'vendor3', 'vendor4', 'vendor5'],
            labels: ['Vendor 1', 'Vendor 2', 'Vendor 3', 'Vendor 4', 'Vendor 5'],
            xLabels: 'day',
            xLabelFormat: function(x) {
                return x.getDate() + "/" + (x.getMonth() + 1).toString().padStart(2, '0');
            },
            yLabelFormat: function(y) {
                return "$" + y.toString();
            },
            pointSize: 3,
            fillOpacity: 0,
            pointStrokeColors: ['#5f76e8', "#01caf1", "#1c2d41", "#fb8c00", "#ff4f70"],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#5f76e8', "#01caf1", "#1c2d41", "#fb8c00", "#ff4f70"],
            resize: true,
        });

        Morris.Donut({
            element: 'abandoned-cart',
            data: [{
                label: "Successfull Transaction",
                value: 47,

            },
            {
                label: "Abandoned Carts",
                value: 20
            }],
            resize: true,
            colors:['#22ca80', '#9eabc0']
        });
    });

    $
</script>
@endsection
