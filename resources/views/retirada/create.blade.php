@section('title', 'Nova Retirada')
<x-app-layout>
<style>
    .form-page { padding: 2rem 1.5rem; min-height: 100%; }
    .form-wrap { max-width: 640px; margin: 0 auto; }
    .form-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .form-title { font-size: 1.125rem; font-weight: 500; margin: 0; color: #111827; }
    .form-back { font-size: 0.875rem; color: #6b7280; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem; }
    .form-back:hover { color: #111827; }
    .panel { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
    .panel-body { padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem; }
    .section-label { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; padding: 1rem 1.25rem 0; }
    .field-label { font-size: 0.8rem; font-weight: 500; color: #374151; display: block; margin-bottom: 0.375rem; }
    .field-input { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; color: #111827; background: #fff; outline: none; transition: border-color .15s; box-sizing: border-box; }
    .field-input:focus { border-color: #6b7280; }
    .field-select { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; color: #111827; background: #fff; outline: none; transition: border-color .15s; box-sizing: border-box; cursor: pointer; }
    .field-select:focus { border-color: #6b7280; }
    .field-error { font-size: 0.75rem; color: #ef4444; margin-top: 0.25rem; }
    .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .produto-card { border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; display: flex; flex-direction: column; gap: 0.75rem; position: relative; }
    .btn-remove { position: absolute; top: 0.75rem; right: 0.75rem; background: none; border: none; cursor: pointer; color: #ef4444; padding: 0.2rem; border-radius: 0.25rem; font-size: 0; transition: background .15s; }
    .btn-remove:hover { background: #fef2f2; }
    .btn-remove svg { width: 1rem; height: 1rem; stroke: currentColor; }
    .btn-add { display: inline-flex; align-items: center; gap: 0.4rem; background: transparent; color: #6b7280; border: 1px dashed #d1d5db; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; cursor: pointer; transition: border-color .15s, color .15s; width: 100%; justify-content: center; font-family: inherit; }
    .btn-add:hover { border-color: #6b7280; color: #374151; }
    .panel-footer { padding: 1rem 1.25rem; border-top: 1px solid #e5e7eb; display: flex; gap: 0.5rem; }
    .btn-save { flex: 1; background: #111827; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: background .15s; font-family: inherit; }
    .btn-save:hover { background: #374151; }
    .btn-cancel { flex: 1; background: #fff; color: #374151; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: border-color .15s; }
    .btn-cancel:hover { border-color: #9ca3af; }
    @media (prefers-color-scheme: dark) {
        .form-title { color: #f3f4f6; }
        .form-back:hover { color: #f3f4f6; }
        .panel { background: #111827; border-color: #374151; }
        .field-label { color: #d1d5db; }
        .field-input { background: #1f2937; border-color: #374151; color: #f3f4f6; }
        .field-select { background: #1f2937; border-color: #374151; color: #f3f4f6; }
        .field-input:focus, .field-select:focus { border-color: #6b7280; }
        .produto-card { border-color: #374151; }
        .btn-remove:hover { background: #450a0a; }
        .btn-add { border-color: #374151; color: #9ca3af; } .btn-add:hover { border-color: #6b7280; color: #d1d5db; }
        .panel-footer { border-top-color: #374151; }
        .btn-save { background: #374151; } .btn-save:hover { background: #4b5563; }
        .btn-cancel { background: transparent; color: #d1d5db; border-color: #374151; }
    }
</style>
<div class="form-page">
    <div class="form-wrap">
        <div class="form-header">
            <h1 class="form-title">Nova retirada</h1>
            <a href="{{ route('retirada.index') }}" class="form-back">
                <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Voltar
            </a>
        </div>
        <div class="panel">
            <form action="{{ route('retirada.store') }}" method="POST">
                @csrf

                <div class="section-label">Informações</div>
                <div class="panel-body">
                    <div>
                        <label class="field-label">Cliente</label>
                        <select class="field-select" name="id_cliente" required>
                            <option value="">Selecione um cliente...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('id_cliente') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_cliente') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="field-grid">
                        <div>
                            <label class="field-label">Data da retirada</label>
                            <input class="field-input" type="date" name="dataRetirada" value="{{ old('dataRetirada', date('Y-m-d')) }}" required>
                            @error('dataRetirada') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="field-label">Observação</label>
                            <input class="field-input" type="text" name="observacao" value="{{ old('observacao') }}">
                            @error('observacao') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    @error('produtos') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="section-label">Produtos</div>
                <div class="panel-body">
                    <div id="produtos-container" style="display:flex; flex-direction:column; gap:0.75rem;">
                        <div class="produto-card">
                            <button type="button" class="btn-remove" onclick="removerProduto(this)" title="Remover">
                                <svg fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                            <div>
                                <label class="field-label">Produto</label>
                                <select class="field-select produto-select" name="produtos[0][id]" required onchange="atualizarMax(this)">
                                    @foreach($produtos as $produto)
                                        <option value="{{ $produto->id }}" data-estoque="{{ $produto->estoque }}">
                                            {{ $produto->nome }} ({{ $produto->estoque }} em estoque)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="field-label">Quantidade</label>
                                <input class="field-input quantidade-input" type="number" name="produtos[0][quantidade]" min="1" required>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-add" onclick="adicionarProduto()">
                        <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Adicionar produto
                    </button>
                </div>

                <div class="panel-footer">
                    <button type="submit" class="btn-save">Registrar retirada</button>
                    <a href="{{ route('retirada.index') }}" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
const produtosData = @json($produtos);
let produtoIndex = 1;

function criarCardProduto(index) {
    const card = document.createElement('div');
    card.className = 'produto-card';
    const opts = produtosData.map(p =>
        `<option value="${p.id}" data-estoque="${p.estoque}">${p.nome} (${p.estoque} em estoque)</option>`
    ).join('');
    card.innerHTML = `
        <button type="button" class="btn-remove" onclick="removerProduto(this)" title="Remover">
            <svg fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div>
            <label class="field-label">Produto</label>
            <select class="field-select produto-select" name="produtos[${index}][id]" required onchange="atualizarMax(this)">
                ${opts}
            </select>
        </div>
        <div>
            <label class="field-label">Quantidade</label>
            <input class="field-input quantidade-input" type="number" name="produtos[${index}][quantidade]" min="1" required>
        </div>`;
    return card;
}

function adicionarProduto() {
    document.getElementById('produtos-container').appendChild(criarCardProduto(produtoIndex++));
}

function removerProduto(btn) {
    const container = document.getElementById('produtos-container');
    if (container.children.length > 1) {
        btn.closest('.produto-card').remove();
    }
}

function atualizarMax(select) {
    const estoque = parseInt(select.options[select.selectedIndex].dataset.estoque);
    select.closest('.produto-card').querySelector('.quantidade-input').max = estoque;
}

document.querySelectorAll('.produto-select').forEach(s => atualizarMax(s));
</script>
</x-app-layout>