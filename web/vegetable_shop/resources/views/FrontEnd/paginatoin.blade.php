@if ($paginator->hasPages())
    <!-- Pagination -->
    <ul class="pagi">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li>
                <a href="#">&lt;</a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}">&lt;</a>
            </li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a>{{ $page }}</a></li>
                    @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @elseif ($page == $paginator->lastPage() - 1)
                        <li class="disabled"><a>...</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}">&gt;</a>
            </li>
        @else
        <li><a href="#">&gt;</a></li>
        @endif
    </ul>
    <!-- Pagination -->
@endif
