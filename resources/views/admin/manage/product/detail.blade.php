@extends('admin.layout')

@section('products-manage-selected')
selected
@endsection

@section('products-manage-link-active')
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Product Detail</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/products')}}" class="text-muted">Products</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Product Detail</li>
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
                            <div class="col-4">
                                <div id="carouselProductImage" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselProductImage" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselProductImage" data-slide-to="1"></li>
                                        <li data-target="#carouselProductImage" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner br-18">
                                        <div class="carousel-item active">
                                        <img class="d-block w-100" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                        <img class="d-block w-100" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                        <img class="d-block w-100" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" alt="Third slide">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselProductImage" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselProductImage" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-8 d-flex flex-column justify-content-center">
                                <h4 class="text-muted m-0">Do It Yourself</h4>
                                <h2 class="card-title mb-2">Cute Tiger Aroma Stone Set”</h2>
                                <div class="d-flex mb-3">
                                    <i style="margin-top: 1px;" class="fas fa-star mr-1"></i>
                                    <h4 class="m-0">3.9 (200 rating)</h4>
                                    <h4 class="mr-3 ml-3 mb-0">|</h4>
                                    <h4 class="mb-0">1.000 sold</h4>
                                </div>
                                <h2 class="text-orange mb-4"><b>$10</b></h2>
                                <p class="m-0">Farewell to the year of Ox, and the Year of Tiger on the way! Over here we launch our cute “Cute Tiger Aroma Stone Set” to welcome the New Year.<br>
                                The stone set is decorated with the festive red dried flowers paired with a blessed essential oil blend and a cute tiger aroma stone! It signifies peace, prosperity, good health, good luck, good dreams, happiness, wealth and all the good things come to you in the “Tiger year”</p>
                                <div class="divider-dash mt-4 mb-4"></div>
                                <h4 class="card-title">Color Variations</h4>
                                <p class="m-0">white, red, blue</p>
                                <div class="divider-dash mt-4 mb-4"></div>
                                <h4 class="card-title">Additional Information</h4>
                                <p class="m-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab, sint eos. Repellendus non consectetur doloribus amet magnam voluptatem, impedit illum veniam molestias nisi accusamus tenetur commodi expedita, mollitia dolorem nulla.</p>
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
                        <h4 class="card-title mb-4">Vendors</h4>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <img width="60" height="60" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" alt="" class="br-18 mr-4">
                                <div class="d-flex flex-column">
                                    <h3 class="card-title mb-0">Pollia</h3>
                                    <small class="mb-2"><b>Location: East</b></small>
                                    <div class="d-flex">
                                        <i style="margin-top: 1px;" class="fas fa-star mr-1"></i>
                                        <h5 class="m-0">3.9</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-15x">
                                <button class="h-75 btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><img src="{{asset('assets/images/whatsapp.svg')}}" width="24" height="24"/>Whatsapp</button>
                                <button class="h-75 btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><i data-feather="mail" class="feather-icon"></i>Email</button>
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
                        <h4 class="card-title">Reviews</h4>
                        <div class="d-flex gap-5x mb-4">
                            <div class="card-selected pr-3 pl-3 pt-2 pb-2 review-filter">
                                <div class="d-flex">
                                    <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                    <h6 class="m-0">5 (300)</h6>
                                </div>
                            </div>
                            <div class="card-not-selected pr-3 pl-3 pt-2 pb-2 review-filter">
                                <div class="d-flex">
                                    <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                    <h6 class="m-0">4 (20)</h6>
                                </div>
                            </div>
                            <div class="card-not-selected pr-3 pl-3 pt-2 pb-2 review-filter">
                                <div class="d-flex">
                                    <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                    <h6 class="m-0">3 (10)</h6>
                                </div>
                            </div>
                            <div class="card-not-selected pr-3 pl-3 pt-2 pb-2 review-filter">
                                <div class="d-flex">
                                    <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                    <h6 class="m-0">2 (2)</h6>
                                </div>
                            </div>
                            <div class="card-not-selected pr-3 pl-3 pt-2 pb-2 review-filter">
                                <div class="d-flex">
                                    <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                    <h6 class="m-0">1 (0)</h6>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            @for($i = 0 ;$i < 5;$i++)
                            @if($i != 0)
                            <div class="divider-dash mt-2 mb-2"></div>
                            @endif
                            <div class="row mt-2 mb-2">
                                <div class="col-2">
                                    <div id="carouselReview{{$i}}" class="carousel slide d-flex align-items-center" data-ride="carousel">
                                        <div class="carousel-inner br-18">
                                            <div class="carousel-item active">
                                            <img class="d-block w-100" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" alt="Third slide">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselReview{{$i}}" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselReview{{$i}}" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-10 m-0 d-flex flex-column justify-content-center">
                                    <h5 class="m-0">Customer Name</h5>
                                    <div class="d-flex">
                                        <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                        <h6 class="m-0">5 (300)</h6>
                                    </div>
                                    <small class="mt-2 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eum aliquam reprehenderit, eius explicabo recusandae nobis voluptatibus labore, repellat exercitationem fugit quod minima amet laudantium velit? Ad debitis facere vitae.</small>
                                </div>
                            </div>
                            @endfor
                            <ul class="pagination justify-content-center mt-4">
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
