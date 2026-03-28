@if ($paginator->hasPages())
<nav class="bouesti-pagination" aria-label="Pagination">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="pagi-btn pagi-disabled">← Prev</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="pagi-btn" rel="prev">← Prev</a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="pagi-btn pagi-dots">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="pagi-btn pagi-active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="pagi-btn">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="pagi-btn" rel="next">Next →</a>
    @else
        <span class="pagi-btn pagi-disabled">Next →</span>
    @endif
</nav>
@endif
