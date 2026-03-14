@if($paginator->hasPages())
<style>
    .pagination { display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; border-top: 1px solid #e5e7eb; flex-wrap: wrap; gap: 0.5rem; }
    .pagination-info { font-size: 0.8rem; color: #9ca3af; }
    .pagination-links { display: flex; align-items: center; gap: 0.25rem; }
    .page-btn { display: inline-flex; align-items: center; justify-content: center; min-width: 2rem; height: 2rem; padding: 0 0.5rem; font-size: 0.8rem; border-radius: 0.375rem; border: 1px solid #e5e7eb; background: #fff; color: #374151; text-decoration: none; transition: all .15s; cursor: pointer; }
    .page-btn:hover { border-color: #9ca3af; color: #111827; }
    .page-btn.active { background: #111827; border-color: #111827; color: #fff; cursor: default; }
    .page-btn.disabled { opacity: 0.4; cursor: not-allowed; pointer-events: none; }
    @media (prefers-color-scheme: dark) {
        .pagination { border-top-color: #374151; }
        .pagination-info { color: #6b7280; }
        .page-btn { background: #1f2937; border-color: #374151; color: #d1d5db; }
        .page-btn:hover { border-color: #6b7280; color: #f3f4f6; }
        .page-btn.active { background: #374151; border-color: #4b5563; color: #f3f4f6; }
    }
</style>
<div class="pagination">
    <span class="pagination-info">
        Mostrando {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} de {{ $paginator->total() }} registros
    </span>
    <div class="pagination-links">
        {{-- Anterior --}}
        @if($paginator->onFirstPage())
            <span class="page-btn disabled">
                <svg style="width:.75rem;height:.75rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-btn">
                <svg style="width:.75rem;height:.75rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
        @endif

        {{-- Páginas --}}
        @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if($page == $paginator->currentPage())
                <span class="page-btn active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Próxima --}}
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-btn">
                <svg style="width:.75rem;height:.75rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        @else
            <span class="page-btn disabled">
                <svg style="width:.75rem;height:.75rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </span>
        @endif
    </div>
</div>
@endif