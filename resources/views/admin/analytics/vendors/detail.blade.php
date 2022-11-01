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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Vendor Name</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/product-analytics')}}" class="text-muted">Vendor Analytics</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Vemdor Name</li>
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
                            <button class="btn btn-primary">Apply</button>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex flex-column justify-content-center">
                                <h2 class="card-title mb-4">Pollia</h2>
                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio illo aliquam cupiditate ex illum repudiandae nulla veritatis dolore eaque facilis delectus fugit odio iure incidunt voluptatibus, aspernatur corrupti est beatae?</p>
                                <p class="m-0">Joined on 3 June 2022</p>
                                <p class="m-0">Total Product: <b>5</b></p>
                                <div class="divider-dash mt-4 mb-4"></div>
                                <h4 class="card-title">Contact</h4>
                                <p class="m-0">pollia@mail.com</p>
                                <p class="m-0">0823183281</p>
                                <div class="d-flex gap-15x justify-content-end">
                                    <button class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><img src="http://localhost/work/bigv/admin/public/assets/images/whatsapp.svg" width="24" height="24">Vendor</button>
                                    <button class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail feather-icon"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>Vendor</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Vendor Product Sales</h4>
                        <p class="mb-0 mt-3">Total Product Sold: <b>401</b></p>
                        <p class="mb-0">Total Income: <b>$401</b></p>
                        <ul class="list-inline text-right">
                            <li class="list-inline-item">
                                <h5><i class="fa fa-circle mr-1 text-purple"></i>Product Sold</h5>
                            </li>
                        </ul>
                        <div id="product-sold"></div>
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
                                <h4 class="card-title m-0">Products Analytics of the Specified Dates from (Vendor Name)</h4>
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
                                            <option value="5">Views</option>
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
                                        <th>Product</th>
                                        <th>Number of Transaction</th>
                                        <th>Total Sold</th>
                                        <th>Total Income</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle">1</td>
                                        <td>
                                            <a href="http://localhost/work/bigv/admin/public/product-analytics/detail" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">17</td>
                                        <td class="align-middle">$128</td>
                                        <td class="align-middle">4.5</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">2</td>
                                        <td>
                                            <a href="http://localhost/work/bigv/admin/public/product-analytics/detail" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">17</td>
                                        <td class="align-middle">$128</td>
                                        <td class="align-middle">4.5</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">3</td>
                                        <td>
                                            <a href="http://localhost/work/bigv/admin/public/product-analytics/detail" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">17</td>
                                        <td class="align-middle">$128</td>
                                        <td class="align-middle">4.5</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">4</td>
                                        <td>
                                            <a href="http://localhost/work/bigv/admin/public/product-analytics/detail" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">17</td>
                                        <td class="align-middle">$128</td>
                                        <td class="align-middle">4.5</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">5</td>
                                        <td>
                                            <a href="http://localhost/work/bigv/admin/public/product-analytics/detail" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">17</td>
                                        <td class="align-middle">$128</td>
                                        <td class="align-middle">4.5</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">6</td>
                                        <td>
                                            <a href="http://localhost/work/bigv/admin/public/product-analytics/detail" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">17</td>
                                        <td class="align-middle">$128</td>
                                        <td class="align-middle">4.5</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">7</td>
                                        <td>
                                            <a href="http://localhost/work/bigv/admin/public/product-analytics/detail" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">17</td>
                                        <td class="align-middle">$128</td>
                                        <td class="align-middle">4.5</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">8</td>
                                        <td>
                                            <a href="http://localhost/work/bigv/admin/public/product-analytics/detail" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">6</td>
                                        <td class="align-middle">17</td>
                                        <td class="align-middle">$128</td>
                                        <td class="align-middle">4.5</td>
                                    </tr>
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
</script>
<script src="{{asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>
<script src="{{asset('assets/libs/morris.js/morris.min.js')}}"></script>
<script src="{{asset('assets/libs/chart.js/dist/Chart.min.js')}}"></script>
<script>
    $(function() {
        "use strict";
        Morris.Area({
            element: 'product-sold',
            data: [{
                    period: '2022-04-12',
                    sold: 50,
                    itouch: 20
                }, {
                    period: '2022-04-13',
                    sold: 130,
                    itouch: 80
                }, {
                    period: '2022-04-14',
                    sold: 80,
                    itouch: 70
                }, {
                    period: '2022-04-15',
                    sold: 70,
                    itouch: 140
                }, {
                    period: '2022-04-16',
                    sold: 180,
                    itouch: 140
                }, {
                    period: '2022-04-17',
                    sold: 105,
                    itouch: 80
                },
                {
                    period: '2022-04-18',
                    sold: 250,
                    itouch: 200
                }
            ],
            xkey: 'period',
            ykeys: ['sold'],
            labels: ['Sold'],
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
