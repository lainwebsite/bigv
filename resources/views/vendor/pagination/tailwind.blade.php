@php($userPagination = true)
@auth
    {{--@if(auth()->user()->role_id == 2)--}}
    @if(strpos(Request::url(), "admin") == true)
        @php ($userPagination = false)
        <ul class="pagination justify-content-center">
        
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a>
                </li>
            @endif
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                {{-- @if (is_string($element))
                        <span aria-disabled="true">
                            <span
                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                        </span>
                    @endif --}}
        
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Next</a>
                </li>
            @endif
        </ul>
    @endif
@endauth

@if ($userPagination == true)
<div class="pagination flex justify-center margin-large" style="gap: 10px; flex-wrap:wrap;">
    @if (!$paginator->onFirstPage())
    <a href="{{ $paginator->previousPageUrl() }}" class="page pagination-not-selected text-style-none"
            style="width: auto; border-radius: 0;">
            <div class="orange-text">Previous</div>
        </a>
    @endif
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        {{-- @if (is_string($element))
                <span aria-disabled="true">
                    <span
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                </span>
            @endif --}}
        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <a href="#" class="page pagination-selected text-style-none">
                        <div class="text-color-white">{{ $page }}</div>
                    </a>
                @else
                <a href="{{ $url }}" class="page pagination-not-selected text-style-none">
                        <div class="orange-text">{{ $page }}</div>
                    </a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
     <a href="{{ $paginator->nextPageUrl() }}" class="page pagination-not-selected text-style-none"
            style="width: auto; border-radius: 0;">
            <div class="orange-text">Next</div>
        </a>
    @endif
</div>
@endif