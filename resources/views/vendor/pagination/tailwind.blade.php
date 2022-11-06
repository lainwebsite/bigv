<div class="pagination flex justify-center margin-large">
    @if (!$paginator->onFirstPage())
        <a href="{{ $paginator->previousPageUrl() }}" class="pagination-not-selected text-style-none">
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
                    <a href="#" class="pagination-selected text-style-none">
                        <div class="text-color-white">1{{ $page }}</div>
                    </a>
                @else
                    <a href="{{ $url }}" class="pagination-not-selected text-style-none">
                        <div class="orange-text">8{{ $page }}</div>
                    </a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="pagination-not-selected text-style-none">
            <div class="orange-text">Next</div>
        </a>
    @endif
</div>
