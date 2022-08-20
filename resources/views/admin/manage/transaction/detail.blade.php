@extends('admin.layout')

@section('orders-manage-selected')
selected
@endsection

@section('orders-manage-link-active')
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Order Detail</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/orders')}}" class="text-muted">Orders</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Order Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <button class="btn btn-danger d-flex gap-15x align-items-center pr-4 pl-4"><i class="fa fa-trash"></i>Delete</button>
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
                <div id="order-status" class="card bg-danger">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 d-flex justify-content-between align-items-center">
                                <div class="m-0">
                                    <h4 class="card-title m-0 text-white">Transaction ID: 14</h4>
                                    <p class="m-0 text-white">13/4/2022</p>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <select id="update-order-status" class="w-auto custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                    <option value="1" selected="1">Payment Pending</option>
                                    <option value="2">Paid</option>
                                    <option value="3">Delivered</option>
                                    <option value="4">Success</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
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
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title mb-4">Customer Info</h4>
                                <p class="m-0">Neilson Soeratman</p>
                                <p class="m-0">082337363440</p>
                                <p class="m-0">Tier Name</p>
                                <div class="divider-dash mt-4 mb-4"></div>
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title mb-4">Billing Address</h4>
                                        <p class="m-0">Neilson Soeratman</p>
                                        <p class="m-0">082337363440</p>
                                        <p class="mb-2">[Block Number] [Street Name]<br>#[Unit Level]-[Unit Number] [Building Name]<br>Singapore [Postal Code]</p>
                                        <small>Additional Information</small>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="card-title mb-4">Shipping Address</h4>
                                        <p class="m-0">Neilson Soeratman</p>
                                        <p class="m-0">082337363440</p>
                                        <p class="mb-2">[Block Number] [Street Name]<br>Singapore [Postal Code]</p>
                                        <small>Additional Information</small>
                                    </div>
                                </div>
                                <div class="divider-dash mt-4 mb-4"></div>
                                <div class="row">
                                    <div class="col">
                                        <h4 class="card-title mb-4">Shipping/Pickup Time</h4>
                                        <p class="m-0">16 August, 2022 | 16:00 - 17:00</p>
                                    </div>
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
                    <h4 class="card-title mb-4">Products</h4>
                        <ul class="list-unstyled">
                            @for ($i = 0; $i < 4; $i++)
                            <li class="media align-items-center mt-3 mb-3 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="d-flex mr-3 br-18" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                    <div class="d-flex flex-column">
                                        <h5 class="mt-0 mb-1"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                        <h6 class="m-0">Color: white</h6>
                                        <h6 class="m-0">$10</h6>
                                    </div>
                                </div>
                                <p class="m-0">x3</p>
                                <p class="m-0">$30</p>
                            </li>
                            @endfor
                        </ul>
                        <div class="divider-dash"></div>
                        <div class="d-flex justify-content-between">
                            <p class="m-0">Product Total</p>
                            <p class="m-0">$30</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="m-0">Shipping Fee</p>
                            <p class="m-0">$2</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="m-0">Discount Subtotal</p>
                            <p class="m-0">$30</p>
                        </div>
                        <div class="divider-dash"></div>
                        <div class="d-flex justify-content-between">
                            <p class="m-0 font-20x"><b>Total</b></p>
                            <p class="m-0 text-orange font-20x"><b>$125</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Discount Applied</h4>
                        <div class="row m-0">
                            @for ($i = 0; $i < 6; $i++)
                            <div class="col-3 pl-1 pr-1 pb-2">
                                <div class="bg-success p-3 br-18">
                                    <h5 class="card-title text-white">BIGVDISCOUNT4</h5>
                                    <h6 class="card-text text-white">40% discount on all shipping fee</h6>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div class="divider-dash mt-4 mb-4"></div>
                        <h4 class="card-title mb-4">Payment</h4>
                        <p class="m-0">Atome</p>
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

@section('javascript-extra')
<script>
    $("#update-order-status").on('change', function(){
        $("#order-status").removeClass("bg-success bg-primary bg-danger bg-cyan");
        if($(this).val() == "1") $("#order-status").addClass("bg-danger");
        else if($(this).val() == "2") $("#order-status").addClass("bg-primary");
        else if($(this).val() == "3") $("#order-status").addClass("bg-cyan");
        else $("#order-status").addClass("bg-success");
    });
</script>
@endsection
