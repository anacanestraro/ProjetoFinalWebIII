@section('title', 'Retiradas')
<x-app-layout>
<style>
    .list-page { padding: 2rem 1.5rem; min-height: 100%; }
    .list-wrap { max-width: 1100px; margin: 0 auto; }
    .list-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; gap: 0.75rem; flex-wrap: wrap; }
    .list-title { font-size: 1.125rem; font-weight: 500; margin: 0; color: #111827; }
    .list-header-right { display: flex; align-items: center; gap: 0.5rem; }
    .btn-new { display: inline-flex; align-items: center; gap: 0.4rem; background: #111827; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; text-decoration: none; cursor: pointer; transition: background .15s; }
    .btn-new:hover { background: #374151; }
    .btn-outline { display: inline-flex; align-items: center; gap: 0.4rem; background: transparent; color: #374151; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; text-decoration: none; cursor: pointer; transition: border-color .15s; position: relative; }
    .btn-outline:hover { border-color: #9ca3af; }
    .search-box { width: 100%; padding: 0.5rem 0.875rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; font-size: 0.875rem; margin: 0; outline: none; background: #fff; color: #111827; }
    .search-box:focus { border-color: #6b7280; }
    .list-table { width: 100%; border-collapse: collapse; }
    .list-table th { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; padding: 0 1rem 0.625rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
    .list-table td { padding: 0.875rem 1rem; font-size: 0.875rem; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    .list-table tr:last-child td { border-bottom: none; }
    .list-table tr:hover td { background: #f9fafb; }
    .item-name { font-weight: 500; color: #111827; }
    .tag-ticket { display: inline-block; font-size: 0.7rem; font-weight: 500; padding: 0.2rem 0.55rem; border-radius: 0.375rem; background: #eff6ff; color: #3b82f6; text-decoration: none; }
    .tag-ticket:hover { background: #dbeafe; }
    .panel { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
    .dropdown-menu { display: none; position: absolute; top: calc(100% + 4px); right: 0; background: #fff; border: 1px solid #e5e7eb; border-radius: 0.5rem; min-width: 180px; z-index: 50; overflow: hidden; }
    .dropdown-menu.open { display: block; }
    .dropdown-menu a { display: block; padding: 0.625rem 1rem; font-size: 0.875rem; color: #374151; text-decoration: none; }
    .dropdown-menu a:hover { background: #f9fafb; }
    @media (prefers-color-scheme: dark) {
        .list-title { color: #f3f4f6; }
        .btn-new { background: #374151; } .btn-new:hover { background: #4b5563; }
        .btn-outline { color: #d1d5db; border-color: #374151; }
        .search-box { background: #1f2937; border-color: #374151; color: #f3f4f6; }
        .list-table th { color: #6b7280; border-bottom-color: #374151; }
        .list-table td { color: #d1d5db; border-bottom-color: #1f2937; }
        .list-table tr:hover td { background: #1f2937; }
        .item-name { color: #f3f4f6; }
        .panel { background: #111827; border-color: #374151; }
        .dropdown-menu { background: #1f2937; border-color: #374151; }
        .dropdown-menu a { color: #d1d5db; } .dropdown-menu a:hover { background: #374151; }
    }
</style>
<div class="list-page">
    <div class="list-wrap">
        <div class="list-header">
            <h1 class="list-title">Retiradas</h1>
            <div class="list-header-right">
                <div style="position:relative;">
                    <button class="btn-outline" onclick="document.getElementById('relDropdown').classList.toggle('open')">
                        <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Relatórios
                        <svg style="width:.75rem;height:.75rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="relDropdown" class="dropdown-menu">
                        <a href="{{ route('produtosSemEstoque') }}">Produtos sem estoque</a>
                        <a href="{{ route('produtosComEstoque') }}">Produtos com estoque</a>
                        <a href="{{ route('retiradasPorCliente') }}">Retiradas por cliente</a>
                    </div>
                </div>
                <a href="{{ route('retirada.create') }}" class="btn-new">
                    <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Nova Retirada
                </a>
            </div>
        </div>
        <div class="panel">
            <div style="padding: 0.875rem 1rem; border-bottom: 1px solid #e5e7eb;">
                <input class="search-box" oninput="filtrar(this.value)" type="text" placeholder="Buscar por cliente...">
            </div>
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Produtos</th>
                        <th>Data</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($retiradas as $retirada)
                    <tr class="retirada-row">
                        <td><span class="item-name nome">{{ $retirada->cliente->nome ?? 'Cliente removido' }}</span></td>
                        <td>
                            @foreach($retirada->produtos as $produto)
                                <span style="font-size:0.8rem; color:#6b7280;">{{ $produto->nome }} ({{ $produto->pivot->quantidade }})</span>@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td style="white-space:nowrap; color:#9ca3af; font-size:0.8rem;">{{ $retirada->created_at->format('d/m/Y') }}</td>
                        <td style="text-align:right; white-space:nowrap;">
                            <a href="{{ route('retirada.ticket', $retirada->id) }}" class="tag-ticket">Ticket</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function filtrar(valor) {
    document.querySelectorAll('.retirada-row').forEach(row => {
        const nome = row.querySelector('.nome').textContent.toLowerCase();
        row.style.display = nome.includes(valor.toLowerCase()) ? '' : 'none';
    });
}
document.addEventListener('click', function(e) {
    if (!e.target.closest('[onclick]')) {
        document.getElementById('relDropdown')?.classList.remove('open');
    }
});
</script>
</x-app-layout>