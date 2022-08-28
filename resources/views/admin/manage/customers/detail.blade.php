@extends('admin.layout')

@section('customers-manage-selected')
selected
@endsection

@section('customers-manage-link-active')
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
            <div class="col-8 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Customer Detail</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/customers')}}" class="text-muted">Customers</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Customer Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <button class="btn btn-danger d-flex gap-15x align-items-center pr-4 pl-4"><i class="fa fa-ban"></i>Ban User</button>
                <button class="btn btn-light d-flex gap-15x align-items-center pr-4 pl-4"><i class="fa fa-ban"></i>Unban User</button>
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
                <div id="order-status" class="card bg-orange">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 d-flex">
                                <div class="m-0">
                                    <h4 class="card-title m-0 text-white">Gold Tier</h4>
                                    <p class="m-0 text-white">Registered since <b>13/4/2022</b></p>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <div class="m-0">
                                    <h4 class="card-title m-0 text-white text-lg-right">36 Visits</h4>
                                    <p class="m-0 text-white">3 Transactions</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Message</h4>
                <div class="row">
                    <div class="col-4">
                        <button class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><img src="{{asset('assets/images/whatsapp.svg')}}" width="24" height="24"/>Customer</button>
                    </div>
                    <div class="col-8 d-flex gap-15x justify-content-end">
                        <button class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><img src="{{asset('assets/images/whatsapp.svg')}}" width="24" height="24"/>Vendor</button>
                        <button class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><i data-feather="mail" class="feather-icon"></i>Vendor</button>
                    </div>
                </div>
            </div>
        </div-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title mb-4">Customer Info</h4>
                                <p class="m-0">Neilson Soeratman</p>
                                <p class="m-0">082337363440</p>
                                <p class="m-0">neilson@mail.com</p>
                                <p class="m-0">Date of Birth <b>13/9/2002</b></p>
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
                        <h4 class="card-title mb-4">Analytics</h4>
                        <div class="align-self-center d-flex align-items-center">
                            <p class="mr-4 mb-0 text-nowrap">Start Date</p>
                            <input type="date" class="form-control w-auto" value="2018-05-13">
                            <p class="ml-4 mr-4 mb-0">-</p>
                            <p class="mr-4 mb-0 text-nowrap">End Date</p>
                            <input type="date" class="form-control w-auto mr-4" value="2018-05-13">
                            <a class="btn btn-primary text-white pr-4 pl-4" href="http://127.0.0.1:8000/products/create">Filter</a>
                        </div>
                        <div class="row mt-5">
                            <div class="col-6">
                                <h5>Customer Total Transactions</h5>
                                <h3 class="text-orange"><b>4</b></h3>

                                <h5>Customer Total Spending</h5>
                                <h3 class="text-orange"><b>$1000</b></h3>

                                <h5 class="mt-3">Customer's Repeat Order Percentage</h5>
                                <h3 class="text-orange"><b>40%</b></h3>
                            </div>
                            <div class="col-6">
                                <h5>Customer's Average Order Amount</h5>
                                <h3 class="text-orange"><b>$100</b></h3>

                                <h5 class="mt-3">Customer's Interval between Orders</h5>
                                <h3 class="text-orange"><b>7.3 days</b></h3>
                            </div>
                        </div>
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
