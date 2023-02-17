@extends('user.template.layout')

@section('page-title')
    Event - BigV
@endsection

@section('meta-title')
    Event - BigV
@endsection

@section('meta-description')
    Take a look at all the Events happening in BigV
@endsection

@section('meta-image')
    {{asset('assets/62ffbe41b946fc3a2b7b6747_Big%20V(NoTag)-ColorB%202.png')}}
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-product-list.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content" style="width: 100vw; min-width: 0 !important; max-width: 1200px; margin:auto;">
        <div class="flex flex-vertical row-gap margin-large" style="width: 85%;position:relative;">
            <h3 class="text-align-center orange-text">All Events</h3>
            <div class="text-align-center">Come and join our community events where we come together and do fun things</div>
        </div>
        <div>
            <div class="flex flex-center top-align relative archive-flex"
                style="width: 100vw; min-width: 0 !important; max-width: 1200px; margin:auto auto 15vh auto;">
                <div style="display:flex; flex-direction: column; align-items:center;width: calc(100% - 288px);">
                    <div class="events-archive-grid" id="eventsList" style="margin-bottom: 8vh;">
                        @foreach ($events as $event)
                            <a href="{{ url('event/' . $event->id) }}" class="text-style-none">
                                <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e75-fac73a6c"
                                    class="event-card padding-small">
                                    <img src="{{ asset('uploads/'.$event->featured_image) }}"
                                        loading="lazy" alt="" class="product-image" />
                                    <div
                                        class="product-card-title text-rich-text text-size-regular text-weight-bold text-color-dark-grey text-center text-truncate">
                                        {{ $event->title }}
                                    </div>
                                    <div class="text-rich-text text-size-small text-color-grey">
                                        {{ $event->date }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-product-list.js') }}" type="text/javascript"></script>
@endsection
