@extends('admin.layout')

@section('customers-analytics-selected')
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Customer Analytics</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Customer Analytics</li>
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
                            <button class="btn btn-primary" id="btnApplyVoucher">Apply</button>
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
                        <h4 class="card-title">Number of New Customers</h4>
                        <ul class="list-inline text-right">
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-purple"></i>New Customer</h5>
                            </li>
                        </ul>
                        <div id="new-customer"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Transaction per Customer Ratio</h4>
                        <small class="mb-0 mt-3">Equation: <b>Number of Transactions / Number of Customer</b></small>
                        <ul class="list-inline text-right">
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-purple"></i>Ratio</h5>
                            </li>
                        </ul>
                        <div id="transaction-customer-ratio"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Average Spending per Customer</h4>
                        <small class="mb-0 mt-3">Equation: <b>Total Spending / Number of Customer</b></small>
                        <ul class="list-inline text-right">
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-purple"></i>Average</h5>
                            </li>
                        </ul>
                        <div id="average-spending"></div>
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
                                <h4 class="card-title m-0">Customer Analytics of the Specified Dates</h4>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex justify-content-end">
                                <div class="d-flex align-items-center">
                                    <p class="mr-4 mb-0">Sort By</p>
                                    <div class="customize-input float-right mr-4">
                                        <select class="custom-select rounded-pill custom-select-set form-control bg-white custom-shadow custom-radius">
                                            <option value="1" selected="">Number of Transaction</option>
                                            <option value="2">Total Spent</option>
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
                                        <th>Name</th>
                                        <th>Number of Transaction</th>
                                        <th>Total Spent</th>
                                        <th>Join Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 1; $i < 9; $i++)
                                    <tr>
                                        <td class="align-middle">{{$i}}</td>
                                        <td>
                                            <a href="{{url('/customer-analytics/detail')}}" class="a-normal d-flex align-items-center">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Hendra Atonius</b></h5>
                                                    <small class="m-0">0831273827</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">$128</td>
                                        <td class="align-middle">Tanggal</td>
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
                        <h4 class="card-title mb-4">Products Information</h4>
                        <h5>Total Number of Products</h5>
                        <h3 class="text-orange"><b>40</b></h3>
                        <h5>Average Price</h5>
                        <h3 class="text-orange"><b>$5</b></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Categories Number of Items</h4>
                        <div>
                            <canvas id="pie-chart" height="150"></canvas>
                        </div>
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
            element: 'new-customer',
            data: [{
                    period: '2022-04-12',
                    customer: 50,
                    itouch: 20
                }, {
                    period: '2022-04-13',
                    customer: 10,
                    itouch: 80
                }, {
                    period: '2022-04-14',
                    customer: 20,
                    itouch: 70
                }, {
                    period: '2022-04-15',
                    customer: 25,
                    itouch: 140
                }, {
                    period: '2022-04-16',
                    customer: 30,
                    itouch: 140
                }, {
                    period: '2022-04-17',
                    customer: 40,
                    itouch: 80
                },
                {
                    period: '2022-04-18',
                    customer: 15,
                    itouch: 200
                }
            ],
            xkey: 'period',
            ykeys: ['customer'],
            labels: ['New Customer'],
            xLabels: 'day',
            xLabelFormat: function(x) {
                return x.getDate() + "/" + (x.getMonth() + 1).toString().padStart(2, '0')
            },
            pointSize: 3,
            fillOpacity: 0,
            pointStrokeColors: ['#5f76e8'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#5f76e8'],
            resize: true,
        });

        Morris.Area({
            element: 'transaction-customer-ratio',
            data: [{
                    period: '2022-04-12',
                    ratio: 1.6,
                    itouch: 20
                }, {
                    period: '2022-04-13',
                    ratio: 1.3,
                    itouch: 80
                }, {
                    period: '2022-04-14',
                    ratio: 1.9,
                    itouch: 70
                }, {
                    period: '2022-04-15',
                    ratio: 2,
                    itouch: 140
                }, {
                    period: '2022-04-16',
                    ratio: 2.3,
                    itouch: 140
                }, {
                    period: '2022-04-17',
                    ratio: 3.2,
                    itouch: 80
                },
                {
                    period: '2022-04-18',
                    ratio: 0.4,
                    itouch: 200
                }
            ],
            xkey: 'period',
            ykeys: ['ratio'],
            labels: ['Ratio'],
            xLabels: 'day',
            xLabelFormat: function(x) {
                return x.getDate() + "/" + (x.getMonth() + 1).toString().padStart(2, '0')
            },
            pointSize: 3,
            fillOpacity: 0,
            pointStrokeColors: ['#5f76e8'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#5f76e8'],
            resize: true,
        });

        Morris.Area({
            element: 'average-spending',
            data: [{
                    period: '2022-04-12',
                    average: 1.6,
                    itouch: 20
                }, {
                    period: '2022-04-13',
                    average: 1.3,
                    itouch: 80
                }, {
                    period: '2022-04-14',
                    average: 1.9,
                    itouch: 70
                }, {
                    period: '2022-04-15',
                    average: 2,
                    itouch: 140
                }, {
                    period: '2022-04-16',
                    average: 2.3,
                    itouch: 140
                }, {
                    period: '2022-04-17',
                    average: 3.2,
                    itouch: 80
                },
                {
                    period: '2022-04-18',
                    average: 0.4,
                    itouch: 200
                }
            ],
            xkey: 'period',
            ykeys: ['average'],
            labels: ['average'],
            xLabels: 'day',
            xLabelFormat: function(x) {
                return x.getDate() + "/" + (x.getMonth() + 1).toString().padStart(2, '0')
            },
            yLabelFormat: function(y) {
                return "$" + y.toString();
            },
            pointSize: 3,
            fillOpacity: 0,
            pointStrokeColors: ['#5f76e8'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#5f76e8'],
            resize: true,
        });
    });

    var backgroundColorList = ["#15267D", "#5e73da", "#b1bdfa", "#8993C3", "#7C92FF", "#2841BE", "#002BFF"];
    new Chart(document.getElementById("pie-chart"), {
        type: 'pie',
        data: {
            labels: ["Food & Beverages", "Clothes", "Eatery", "Muslim Owned"],
            datasets: [{
                label: "Population (millions)",
                backgroundColor: backgroundColorList.slice(0, 4),
                data: [4, 20, 37, 10]
            }]
        },
    });
</script>
@endsection
