@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Page précédente --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fas fa-arrow-left"></i> <!-- Flèche gauche -->
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link">
                        <i class="fas fa-arrow-left"></i> <!-- Flèche gauche -->
                    </a>
                </li>
            @endif

            {{-- Pages numérotées --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @elseif (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Page suivante --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
                        <i class="fas fa-arrow-right"></i> <!-- Flèche droite -->
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fas fa-arrow-right"></i> <!-- Flèche droite -->
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
    /* Personnalisation des boutons de pagination */
.pagination .page-item.active .page-link {
    background-color: rgba(11, 77, 209, 0.714);
    border-color: #1b39cebb;
    color: white;
}

.pagination .page-item.disabled .page-link {
    background-color: #f1f1f1;
    border-color: #f1f1f1;
    color: #ccc;
}

.pagination .page-item .page-link {
    border: 1px solid #ddd;
    color: #333;
    padding: 0.5rem 1rem;
}

.page-link i {
    font-size: 1.2rem; /* Taille de la flèche */
}
</style>
