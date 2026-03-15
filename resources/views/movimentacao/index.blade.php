@section('title', 'Histórico de Movimentações')
<x-app-layout>
<style>
    .list-page { padding: 2rem 1.5rem; min-height: 100%; }
    .list-wrap { max-width: 1100px; margin: 0 auto; }
    .list-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; gap: 0.75rem; flex-wrap: wrap; }
    .list-title { font-size: 1.125rem; font-weight: 500; margin: 0; color: #111827; }
    .panel { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
    .list-table { width: 100%; border-collapse: collapse; }
    .list-table th { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; padding: 0 1rem 0.625rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
    .list-table td { padding: 0.875rem 1rem; font-size: 0.875rem; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    .list-table tr:last-child td { border-bottom: none; }
    .list-table tr:hover td { background: #f9fafb; }
    .item-name { font-weight: 500; color: #111827; }
    .badge-entrada { display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.7rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 9999px; background: #f0fdf4; color: #16a34a; }
    .badge-saida { display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.7rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 9999px; background: #fef2f2; color: #dc2626; }
    .estoque-flow { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; }
    .estoque-arrow { color: #9ca3af; }
    @media (prefers-color-scheme: dark) {
        .list-title { color: #f3f4f6; }
        .panel { background: #111827; border-color: #374151; }
        .list-table th { color: #6b7280; border-bottom-color: #374151; }
        .list-table td { color: #d1d5db; border-bottom-color: #1f2937; }
        .list-table tr:hover td { background: #1f2937; }
        .item-name { color: #f3f4f6; }
    }
</style>
<div class="list-page">
    <div class="list-wrap">
        <div class="list-header">
            <h1 class="list-title">Histórico de Movimentações</h1>
        </div>
        <div class="panel">
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Produto</th>
                        <th>Tipo</th>
                        <th>Quantidade</th>
                        <th>Estoque</th>
                        <th>Motivo</th>
                        <th>Usuário</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movimentacoes as $mov)
                    <tr>
                        <td style="white-space:nowrap; color:#9ca3af; font-size:0.8rem;">
                            {{ $mov->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            <a href="{{ route('movimentacao.produto', $mov->produto_id) }}"
                               style="text-decoration:none;">
                                <span class="item-name">{{ $mov->produto->nome ?? '—' }}</span>
                            </a>
                        </td>
                        <td>
                            @if($mov->tipo === 'entrada')
                                <span class="badge-entrada">
                                    <svg style="width:.625rem;height:.625rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                    Entrada
                                </span>
                            @else
                                <span class="badge-saida">
                                    <svg style="width:.625rem;height:.625rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                    Saída
                                </span>
                            @endif
                        </td>
                        <td style="font-weight:500;">{{ $mov->quantidade }}</td>
                        <td>
                            <div class="estoque-flow">
                                <span>{{ $mov->estoque_antes }}</span>
                                <span class="estoque-arrow">→</span>
                                <span style="font-weight:500;">{{ $mov->estoque_depois }}</span>
                            </div>
                        </td>
                        <td style="color:#6b7280; font-size:0.8rem;">{{ $mov->motivo ?? '—' }}</td>
                        <td style="color:#6b7280; font-size:0.8rem;">{{ $mov->user->name ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:3rem; color:#9ca3af;">
                            Nenhuma movimentação registrada ainda.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @include('components.pagination', ['paginator' => $movimentacoes])
        </div>
    </div>
</div>
</x-app-layout>