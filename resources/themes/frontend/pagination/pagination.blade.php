@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a class="page-item page-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <i class="fi fi-previous"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="space">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-item page-number active">{{ $page }}</span>
                    @else
                        <a class="page-item page-number" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="page-item page-next" href="{{ $paginator->nextPageUrl() }}"  rel="next">
                <i class="fi fi-next"></i>
            </a>
        @endif
    </div>
@endif








