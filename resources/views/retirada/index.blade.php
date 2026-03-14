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

    .dropdown-menu { display: none; position: absolute; top: calc(100% + 4px); right: 0; background: #fff; border: 1px solid #e5e7eb; border-radius: 0.5rem; min-width: 220px; z-index: 50; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,.08); }
    .dropdown-menu.open { display: block; }
    .dropdown-menu a, .dropdown-menu button.dd-item { display: flex; align-items: center; gap: 0.5rem; width: 100%; padding: 0.625rem 1rem; font-size: 0.875rem; color: #374151; text-decoration: none; background: none; border: none; cursor: pointer; font-family: inherit; text-align: left; transition: background .1s; }
    .dropdown-menu a:hover, .dropdown-menu button.dd-item:hover { background: #f9fafb; }
    .dd-divider { border: none; border-top: 1px solid #e5e7eb; margin: 0.25rem 0; }
    .dd-section { font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; padding: 0.5rem 1rem 0.25rem; }

    /* Modal de período */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 100; align-items: center; justify-content: center; }
    .modal-overlay.open { display: flex; }
    .modal { background: #fff; border-radius: 0.75rem; padding: 1.5rem; width: 100%; max-width: 380px; }
    .modal-title { font-size: 1rem; font-weight: 500; color: #111827; margin-bottom: 1rem; }
    .modal-field { margin-bottom: 0.875rem; }
    .modal-label { font-size: 0.8rem; font-weight: 500; color: #374151; display: block; margin-bottom: 0.375rem; }
    .modal-input { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; color: #111827; background: #fff; outline: none; box-sizing: border-box; }
    .modal-input:focus { border-color: #6b7280; }
    .modal-footer { display: flex; gap: 0.5rem; margin-top: 1.25rem; }
    .modal-btn-ok { flex: 1; background: #111827; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; font-family: inherit; }
    .modal-btn-ok:hover { background: #374151; }
    .modal-btn-cancel { flex: 1; background: #fff; color: #374151; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; font-family: inherit; }
    .modal-btn-cancel:hover { border-color: #9ca3af; }

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
        .dropdown-menu a, .dropdown-menu button.dd-item { color: #d1d5db; } 
        .dropdown-menu a:hover, .dropdown-menu button.dd-item:hover { background: #374151; }
        .dd-divider { border-top-color: #374151; }
        .modal { background: #1f2937; }
        .modal-title { color: #f3f4f6; }
        .modal-label { color: #d1d5db; }
        .modal-input { background: #111827; border-color: #374151; color: #f3f4f6; }
        .modal-btn-cancel { background: transparent; color: #d1d5db; border-color: #374151; }
    }
</style>

<div class="list-page">
    <div class="list-wrap">
        <div class="list-header">
            <h1 class="list-title">Retiradas</h1>
            <div class="list-header-right">
                <div style="position:relative;">
                    <button class="btn-outline" onclick="toggleDropdown()">
                        <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Relatórios
                        <svg style="width:.75rem;height:.75rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="relDropdown" class="dropdown-menu">
                        <div class="dd-section">Produtos</div>
                        <a href="{{ route('produtosSemEstoque') }}">
                            <svg style="width:.875rem;height:.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                            Produtos sem estoque
                        </a>
                        <a href="{{ route('produtosComEstoque') }}">
                            <svg style="width:.875rem;height:.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                            Produtos com estoque
                        </a>
                        <a href="{{ route('estoqueCritico') }}">
                            <svg style="width:.875rem;height:.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                            Estoque crítico
                        </a>
                        <a href="{{ route('movimentacaoEstoque') }}">
                            <svg style="width:.875rem;height:.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                            Movimentação de estoque
                        </a>
                        <hr class="dd-divider">
                        <div class="dd-section">Retiradas</div>
                        <a href="{{ route('retiradasPorCliente') }}">
                            <svg style="width:.875rem;height:.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Retiradas por cliente
                        </a>
                        <button class="dd-item" onclick="abrirModalPeriodo()">
                            <svg style="width:.875rem;height:.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Retiradas por período
                        </button>
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
        @include('components.pagination', ['paginator' => $retiradas])
        </div>
    </div>
</div>

{{-- Modal filtro de período --}}
<div class="modal-overlay" id="modalPeriodo" onclick="fecharModalFora(event)">
    <div class="modal">
        <p class="modal-title">Retiradas por período</p>
        <div class="modal-field">
            <label class="modal-label">Data inicial</label>
            <input class="modal-input" type="date" id="dataInicio" value="{{ now()->startOfMonth()->format('Y-m-d') }}">
        </div>
        <div class="modal-field">
            <label class="modal-label">Data final</label>
            <input class="modal-input" type="date" id="dataFim" value="{{ now()->format('Y-m-d') }}">
        </div>
        <div class="modal-footer">
            <button class="modal-btn-ok" onclick="gerarRelatorioPeriodo()">Gerar PDF</button>
            <button class="modal-btn-cancel" onclick="fecharModal()">Cancelar</button>
        </div>
    </div>
</div>

<script>
function toggleDropdown() {
    document.getElementById('relDropdown').classList.toggle('open');
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.btn-outline') && !e.target.closest('.dropdown-menu')) {
        document.getElementById('relDropdown')?.classList.remove('open');
    }
});

function filtrar(valor) {
    document.querySelectorAll('.retirada-row').forEach(row => {
        const nome = row.querySelector('.nome').textContent.toLowerCase();
        row.style.display = nome.includes(valor.toLowerCase()) ? '' : 'none';
    });
}

function abrirModalPeriodo() {
    document.getElementById('relDropdown').classList.remove('open');
    document.getElementById('modalPeriodo').classList.add('open');
}

function fecharModal() {
    document.getElementById('modalPeriodo').classList.remove('open');
}

function fecharModalFora(e) {
    if (e.target === document.getElementById('modalPeriodo')) fecharModal();
}

function gerarRelatorioPeriodo() {
    const inicio = document.getElementById('dataInicio').value;
    const fim = document.getElementById('dataFim').value;
    if (!inicio || !fim) { alert('Preencha as duas datas.'); return; }
    if (inicio > fim) { alert('A data inicial não pode ser maior que a final.'); return; }
    window.open(`{{ route('retiradasPorPeriodo') }}?dataInicio=${inicio}&dataFim=${fim}`, '_blank');
    fecharModal();
}
</script>
</x-app-layout>