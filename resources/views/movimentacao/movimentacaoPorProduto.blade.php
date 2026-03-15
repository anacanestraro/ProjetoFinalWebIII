@section('title', 'Movimentações — {{ $produto->nome }}')
<x-app-layout>
<style>
    .list-page { padding: 2rem 1.5rem; min-height: 100%; }
    .list-wrap { max-width: 1100px; margin: 0 auto; }
    .list-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; gap: 0.75rem; flex-wrap: wrap; }
    .list-title { font-size: 1.125rem; font-weight: 500; margin: 0; color: #111827; }
    .form-back { font-size: 0.875rem; color: #6b7280; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem; }
    .form-back:hover { color: #111827; }
    .summary { display: grid; gap: 0.75rem; margin-bottom: 1.25rem; }
    .summary-inner { display: flex; gap: 0.75rem; }
    .stat-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem 1.25rem; flex: 1; }
    .stat-label { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; margin-bottom: 0.375rem; }
    .stat-value { font-size: 1.5rem; font-weight: 500; color: #111827; }
    .entrada-form { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem; margin-bottom: 1.25rem; }
    .entrada-form h2 { font-size: 0.875rem; font-weight: 500; color: #111827; margin-bottom: 1rem; }
    .form-row { display: flex; gap: 0.75rem; align-items: flex-end; flex-wrap: wrap; }
    .field { display: flex; flex-direction: column; gap: 0.375rem; }
    .field-label { font-size: 0.8rem; font-weight: 500; color: #374151; }
    .field-input { padding: 0.5rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; color: #111827; background: #fff; outline: none; }
    .field-input:focus { border-color: #6b7280; }
    .btn-save { background: #111827; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1.25rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; font-family: inherit; white-space: nowrap; }
    .btn-save:hover { background: #374151; }
    .panel { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
    .list-table { width: 100%; border-collapse: collapse; }
    .list-table th { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; padding: 0 1rem 0.625rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
    .list-table td { padding: 0.875rem 1rem; font-size: 0.875rem; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    .list-table tr:last-child td { border-bottom: none; }
    .list-table tr:hover td { background: #f9fafb; }
    .badge-entrada { display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.7rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 9999px; background: #f0fdf4; color: #16a34a; }
    .badge-saida { display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.7rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 9999px; background: #fef2f2; color: #dc2626; }
    .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #16a34a; padding: 0.75rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; margin-bottom: 1rem; }
    @media (prefers-color-scheme: dark) {
        .list-title { color: #f3f4f6; }
        .form-back:hover { color: #f3f4f6; }
        .stat-card { background: #111827; border-color: #374151; }
        .stat-value { color: #f3f4f6; }
        .entrada-form { background: #111827; border-color: #374151; }
        .entrada-form h2 { color: #f3f4f6; }
        .field-label { color: #d1d5db; }
        .field-input { background: #1f2937; border-color: #374151; color: #f3f4f6; }
        .btn-save { background: #374151; } .btn-save:hover { background: #4b5563; }
        .panel { background: #111827; border-color: #374151; }
        .list-table th { color: #6b7280; border-bottom-color: #374151; }
        .list-table td { color: #d1d5db; border-bottom-color: #1f2937; }
        .list-table tr:hover td { background: #1f2937; }
    }
</style>
<div class="list-page">
    <div class="list-wrap">

        <div class="list-header">
            <h1 class="list-title">{{ $produto->nome }}</h1>
            <a href="{{ route('movimentacao.index') }}" class="form-back">
                <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Voltar
            </a>
        </div>

        @if(session('mensagem'))
            <div class="alert-success">{{ session('mensagem') }}</div>
        @endif

        {{-- Cards de resumo --}}
        <div class="summary">
            <div class="summary-inner">
                <div class="stat-card">
                    <div class="stat-label">Estoque atual</div>
                    <div class="stat-value">{{ $produto->estoque }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Estoque inicial</div>
                    <div class="stat-value">{{ $produto->estoqueInicial ?? '—' }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total de movimentações</div>
                    <div class="stat-value">{{ $movimentacoes->total() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total retirado</div>
                    <div class="stat-value">{{ $produto->movimentacoes()->where('tipo', 'saida')->sum('quantidade') }}</div>
                </div>
            </div>
        </div>

        {{-- Formulário de entrada --}}
        <div class="entrada-form">
            <h2>Registrar entrada de estoque</h2>
            <form action="{{ route('movimentacao.entrada') }}" method="POST">
                @csrf
                <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                <div class="form-row">
                    <div class="field">
                        <label class="field-label">Quantidade</label>
                        <input class="field-input" type="number" name="quantidade" min="1" placeholder="0" style="width:100px;" required>
                    </div>
                    <div class="field" style="flex:1; min-width:200px;">
                        <label class="field-label">Motivo</label>
                        <input class="field-input" type="text" name="motivo" placeholder="Ex: Reposição de estoque">
                    </div>
                    <button type="submit" class="btn-save">Registrar entrada</button>
                </div>
            </form>
        </div>

        {{-- Histórico --}}
        <div class="panel">
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Data</th>
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
                        <td style="font-size:0.8rem;">
                            {{ $mov->estoque_antes }} → <strong>{{ $mov->estoque_depois }}</strong>
                        </td>
                        <td style="color:#6b7280; font-size:0.8rem;">{{ $mov->motivo ?? '—' }}</td>
                        <td style="color:#6b7280; font-size:0.8rem;">{{ $mov->user->name ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:3rem; color:#9ca3af;">
                            Nenhuma movimentação registrada para este produto.
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