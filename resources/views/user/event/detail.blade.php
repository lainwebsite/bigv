@extends('user.template.layout')

@section('page-title')
    {{$event->title}} - BigV
@endsection

@section('meta-title')
    {{$event->title}} - BigV
@endsection

@section('meta-description')
    {{$event->description}}
@endsection

@section('meta-image')
    {{ asset('uploads/'.$event->featured_image) }}
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-product-list.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="content" style="width: 100vw; min-width: 0 !important; max-width: 1000px; margin:auto auto 20vh auto;">
        <div class="vendor-details row" style="gap:0 !important; margin: 0 !important; width: 100%;">
            <div class="vendor-left-column col-12 mb-4 ">
                <div class="w-100 d-flex justify-content-center">
                    <img src="{{ asset('uploads/'.$event->featured_image) }}" class="w-100" style="border-radius: 27px;"
                        alt="">
                </div>
            </div>
            <div class="col-12">
                <div class="pricing-content">
                    <div class="tagline d-flex justify-content-center" style="margin-bottom: 0px;"><strong>Join our Event!</strong></div>
                    <div class="pricing-info justify-content-center">
                        <h3 class="orange-text">{{ $event->title }}</h3>
                    </div>
                    <div class="pricing-divider-two"></div>
                    @if ($event->date != null)
                    <div class="pricing-block">
                        <p class="tagline" style="margin-bottom: 0px;">Event Date</p>
                        <p class="pricing-details-text">{{$event->date}}</p>
                    </div>
                    @endif
                    <p class="mt-4">
                    {!! nl2br(e($event->description)) !!}
                    </p>
                    @if ($event->button_name != null)
                    <div class="d-flex justify-content-center">
                        <a href="{{$event->button_url}}" class="button margin-top margin-large ea-grow w-button">{{$event->button_name}}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-product-list.js') }}" type="text/javascript"></script>
@endsection
