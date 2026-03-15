@section('title', 'Detalhes do Produto')
<x-app-layout>
<style>
    .show-page { padding: 2rem 1.5rem; min-height: 100%; }
    .show-wrap { max-width: 640px; margin: 0 auto; }
    .show-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .show-title { font-size: 1.125rem; font-weight: 500; margin: 0; color: #111827; }
    .show-back { font-size: 0.875rem; color: #6b7280; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem; }
    .show-back:hover { color: #111827; }
    .panel { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
    .panel-img { width: 100%; max-height: 300px; object-fit: contain; display: block; border-bottom: 1px solid #e5e7eb; background: #f9fafb; padding: 1rem; }
    .panel-body { padding: 1.25rem; }
    .field-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 0.625rem 0; border-bottom: 1px solid #f3f4f6; }
    .field-row:last-child { border-bottom: none; }
    .field-label { font-size: 0.8rem; color: #9ca3af; font-weight: 500; }
    .field-value { font-size: 0.875rem; color: #111827; font-weight: 500; text-align: right; }
    .badge-ok { font-size: 0.75rem; font-weight: 500; padding: 0.2rem 0.6rem; border-radius: 9999px; background: #f0fdf4; color: #16a34a; }
    .badge-warn { font-size: 0.75rem; font-weight: 500; padding: 0.2rem 0.6rem; border-radius: 9999px; background: #fefce8; color: #ca8a04; }
    .badge-zero { font-size: 0.75rem; font-weight: 500; padding: 0.2rem 0.6rem; border-radius: 9999px; background: #fef2f2; color: #dc2626; }
    .actions { display: flex; gap: 0.5rem; padding: 1rem 1.25rem; border-top: 1px solid #e5e7eb; }
    .btn-edit { flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; background: #111827; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; text-decoration: none; cursor: pointer; transition: background .15s; }
    .btn-edit:hover { background: #374151; }
    .btn-del { flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; background: #fff; color: #ef4444; border: 1px solid #fecaca; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: background .15s; font-family: inherit; }
    .btn-del:hover { background: #fef2f2; }
    @media (prefers-color-scheme: dark) {
        .show-title { color: #f3f4f6; }
        .show-back { color: #6b7280; } .show-back:hover { color: #f3f4f6; }
        .panel { background: #111827; border-color: #374151; }
        .panel-img { border-bottom-color: #374151; }
        .field-row { border-bottom-color: #1f2937; }
        .field-value { color: #f3f4f6; }
        .actions { border-top-color: #374151; }
        .btn-edit { background: #374151; } .btn-edit:hover { background: #4b5563; }
        .btn-del { background: transparent; border-color: #7f1d1d; } .btn-del:hover { background: #450a0a; }
    }
</style>
<div class="show-page">
    <div class="show-wrap">
        <div class="show-header">
            <h1 class="show-title">{{ $produto->nome }}</h1>
            <a href="{{ route('produto.index') }}" class="show-back">
                <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Voltar
            </a>
        </div>
        <div class="panel">
            <img src="{{ asset('img/produtos/'.$produto->imagem) }}" alt="{{ $produto->nome }}" class="panel-img">
            <div class="panel-body">
                <div class="field-row">
                    <span class="field-label">Nome</span>
                    <span class="field-value">{{ $produto->nome }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Descrição</span>
                    <span class="field-value">{{ $produto->descricao }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Valor unitário</span>
                    <span class="field-value">R$ {{ number_format($produto->valorUnitario, 2, ',', '.') }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Categoria</span>
                    <span class="field-value">{{ $produto->categoria->nome ?? '—' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Unidade</span>
                    <span class="field-value">{{ $produto->unidade->sigla ?? '—' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Estoque</span>
                    <span class="field-value">
                        @if($produto->estoque == 0)
                            <span class="badge-zero">0 em estoque</span>
                        @elseif($produto->estoque <= 5)
                            <span class="badge-warn">{{ $produto->estoque }}</span>
                        @else
                            <span class="badge-ok">{{ $produto->estoque }}</span>
                        @endif
                    </span>
                </div>
                <div class="field-row">
                    <span class="field-label">Estoque inicial</span>
                    <span class="field-value">{{ $produto->estoqueInicial ?? '—' }}</span>
                </div>
            </div>
            <div class="actions">
                <a href="{{ route('movimentacao.produto', $produto->id) }}" class="btn-edit" style="background:#16a34a;">Entrada de estoque</a>
                <a href="{{ route('produto.edit', $produto->id) }}" class="btn-edit">Editar</a>
                <form action="{{ route('produto.destroy', $produto->id) }}" method="POST" style="flex:1;" onsubmit="return confirm('Tem certeza que deseja deletar?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-del" style="width:100%;">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>