<style>
    nav {
        max-width: 1230px;
    }

    .pagination-custom {
        width: 80%;
        margin: 30px auto;
        list-style: none;
        display: flex;
        /* justify-content: space-between; */
        align-items: center;
    }

    .pagination-info {
        width: 30%;
        float: left;
    }

    .pagination-list {
        width: 10%;
        float: right;
    }

    .pagination-custom li {
        margin: 0 5px;
    }
</style>
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination-custom">
            {{-- Information about the data range --}}
            <li class="pagination-info">
                全{{ $paginator->total() }}件中{{ $paginator->firstItem() }}～{{ $paginator->lastItem() }}件
            </li>

            {{-- Pagination Elements --}}
            <li class="pagination-list">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
            <li class="disabled">
                <span aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
@endif

@foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
        <li class="disabled">
            <span>{{ $element }}</span>
        </li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
        @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
                <li class="active">
                    {{ $page }}
                </li>
            @else
                <li>
                    <a href="{{ $url }}">{{ $page }}</a>
                </li>
            @endif
        @endforeach
    @endif
@endforeach

{{-- Next Page Link --}}
@if ($paginator->hasMorePages())
    <li>
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
    </li>
@else
    <li class="disabled">
        <span aria-hidden="true">&rsaquo;</span>
    </li>
@endif
</li>
</ul>
</nav>
@endif
