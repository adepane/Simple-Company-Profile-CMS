@if ($paginator->hasPages())
    {{-- <nav> --}}
        <ul class="kt-pagination__links">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="kt-pagination__link--prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a  aria-hidden="true"><i class="fa fa-angle-left kt-font-brand"></i></a>
                </li>
            @else
                <li class="kt-pagination__link--prev">
                    <a  href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa fa-angle-left kt-font-brand"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><a href="#">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="kt-pagination__link--active disabled" aria-current="page"><a class="">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="kt-pagination__link--next">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="fa fa-angle-right kt-font-brand"></i></a>
                </li>
            @else
                <li class="kt-pagination__link--next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a aria-hidden="true"><i class="fa fa-angle-right kt-font-brand"></i></a>
                </li>
            @endif
        </ul>
    {{-- </nav> --}}
@endif
