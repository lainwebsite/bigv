@foreach ($reviews as $key => $productReview)
    @if (!$loop->first)
        <div class="divider-dash mt-2 mb-2"></div>
    @endif
    <div class="row mt-2 mb-2">
        <div class="col-2">
            <div id="carouselReview{{ $key }}" class="carousel slide d-flex align-items-center"
                data-ride="carousel">
                <div class="carousel-inner br-18">
                    @foreach ($productReview->images as $image)
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('uploads/' . $image->link) }}" alt="First slide">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselReview{{ $key }}" role="button"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselReview{{ $key }}" role="button"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-10 m-0 d-flex flex-column justify-content-center">
            <h5 class="m-0">{{ $productReview->user->name }}</h5>
            <div class="d-flex">
                <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                <h6 class="m-0">{{ $productReview->rating }}</h6>
            </div>
            <small class="mt-2 mb-0">{{ $productReview->description }}</small>
        </div>
    </div>
@endforeach
{{ $reviews->links() }}
