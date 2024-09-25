
<!-- resources/views/vendor/pagination/bootstrap-5.blade.php -->
<div class="d-flex align-items-center me-3">
    <p class="small text-muted">
        {!! __('Showing') !!}
        <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
        {!! __('to') !!}
        <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
        {!! __('of') !!}
        <span class="fw-semibold">{{ $paginator->total() }}</span>
        {!! __('results') !!}
    </p>
</div>
<div>
    @if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm justify-content-center">

            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link text-secondary">Previous</span></li>
            @else
                <li class="page-item "><a class="page-link text-secondary" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item bg-secondary  active"><span class="page-link border-secondary bg-secondary">{{ $page }}</span></li>
                        @elseif ($page == 1 || $page == $paginator->lastPage() || ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2))
                            <li class="page-item"><a class="page-link text-secondary" href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->currentPage() - 3 || $page == $paginator->currentPage() + 3)
                            <li class="page-item disabled"><span class="page-link text-secondary">...</span></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link text-secondary" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>
    </nav>
@endif
</div>


