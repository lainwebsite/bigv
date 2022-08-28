@extends('admin.layout')

@section('vendors-manage-selected')
selected
@endsection

@section('vendors-manage-link-active')
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Vendor Detail</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.vendor.index')}}" class="text-muted">Vendors</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Vendor Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-end gap-15x">
                <a href="#" class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 text-white"><i class="fa fa-edit text-white"></i>Edit</a>
                <a href="#" class="btn btn-danger d-flex gap-15x align-items-center pr-4 pl-4 text-white"><i class="fa fa-trash text-white"></i>Delete</a>
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
                        <div class="row">
                            <div class="col-12 d-flex flex-column justify-content-center">
                                <h2 class="card-title mb-4">Pollia</h2>
                                <p class="m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio illo aliquam cupiditate ex illum repudiandae nulla veritatis dolore eaque facilis delectus fugit odio iure incidunt voluptatibus, aspernatur corrupti est beatae?</p>
                                <div class="divider-dash mt-4 mb-4"></div>
                                <h4 class="card-title">Contact</h4>
                                <p class="m-0">pollia@mail.com</p>
                                <p class="m-0">0823183281</p>
                                <div class="d-flex gap-15x justify-content-end">
                                    <button class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><img src="{{asset('assets/images/whatsapp.svg')}}" width="24" height="24"/>Vendor</button>
                                    <button class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><i data-feather="mail" class="feather-icon"></i>Vendor</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Variations</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 5; $i++)
                                    <tr>
                                        <td>
                                            <a href="/productdet" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">$10</td>
                                        <td class="align-middle">Red, Yellow, Blue, Black</td>
                                        <td class="align-middle">
                                            <div class="d-flex" style="gap: 10px;">
                                                <a href="" class="a-normal text-info"><i data-feather="edit" class="feather-icon"></i></a>
                                                <a href="" class="a-normal text-danger"><i data-feather="trash" class="feather-icon"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endfor
                                    <tr>
                                        <td>
                                            <a href="" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle"><s>$20</s><br>$10</td>
                                        <td class="align-middle">Red, Yellow, Blue, Black</td>
                                        <td class="align-middle">
                                            <div class="d-flex" style="gap: 10px;">
                                                <a href="" class="a-normal text-info"><i data-feather="edit" class="feather-icon"></i></a>
                                                <a href="" class="a-normal text-danger"><i data-feather="trash" class="feather-icon"></i></a>
                                            </div>
                                        </td>
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
    $(".review-filter").on('click',function(){
        $(".review-filter").removeClass("card-selected");
        $(".review-filter").addClass("card-not-selected");
        $(this).removeClass("card-not-selected");
        $(this).addClass("card-selected");
    });
</script>
@endsection
