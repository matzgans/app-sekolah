@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center"
            style="--bs-pagination-bg: #e0e5ec; --bs-pagination-disabled-bg: #e0e5ec;">

            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link rounded-circle mx-1 border-0 p-0"
                        style="width: 40px; height: 40px; line-height: 40px; text-align: center; box-shadow: inset 5px 5px 10px #babecc, inset -5px -5px 10px #ffffff;">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link rounded-circle mx-1 border-0 p-0" href="{{ $paginator->previousPageUrl() }}"
                        style="width: 40px; height: 40px; line-height: 40px; text-align: center; box-shadow: 5px 5px 10px #babecc, -5px -5px 10px #ffffff;"
                        rel="prev">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Elemen Paginasi (Angka) --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled mx-1"><span class="page-link border-0">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- Gaya "Pressed In" untuk halaman aktif --}}
                            <li class="page-item active" aria-current="page">
                                <span class="page-link rounded-circle mx-1 border-0 p-0"
                                    style="width: 40px; height: 40px; line-height: 40px; text-align: center; box-shadow: inset 5px 5px 10px #babecc, inset -5px -5px 10px #ffffff;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            {{-- Gaya "Popped Out" untuk halaman lain --}}
                            <li class="page-item">
                                <a class="page-link rounded-circle mx-1 border-0 p-0" href="{{ $url }}"
                                    style="width: 40px; height: 40px; line-height: 40px; text-align: center; box-shadow: 5px 5px 10px #babecc, -5px -5px 10px #ffffff;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-circle mx-1 border-0 p-0" href="{{ $paginator->nextPageUrl() }}"
                        style="width: 40px; height: 40px; line-height: 40px; text-align: center; box-shadow: 5px 5px 10px #babecc, -5px -5px 10px #ffffff;"
                        rel="next">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link rounded-circle mx-1 border-0 p-0"
                        style="width: 40px; height: 40px; line-height: 40px; text-align: center; box-shadow: inset 5px 5px 10px #babecc, inset -5px -5px 10px #ffffff;">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
