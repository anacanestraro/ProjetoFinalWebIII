@section('title', 'Detalhes do Cliente')
<x-app-layout>
<style>
    .show-page { padding: 2rem 1.5rem; min-height: 100%; }
    .show-wrap { max-width: 640px; margin: 0 auto; }
    .show-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .show-title { font-size: 1.125rem; font-weight: 500; margin: 0; color: #111827; }
    .show-back { font-size: 0.875rem; color: #6b7280; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem; }
    .show-back:hover { color: #111827; }
    .panel { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
    .panel-top { padding: 1.5rem 1.25rem; display: flex; align-items: center; gap: 1rem; border-bottom: 1px solid #e5e7eb; }
    .avatar { width: 3rem; height: 3rem; border-radius: 50%; background: #ede9fe; display: flex; align-items: center; justify-content: center; font-size: 1rem; font-weight: 600; color: #7c3aed; flex-shrink: 0; }
    .panel-name { font-size: 1rem; font-weight: 500; color: #111827; margin: 0; }
    .panel-email { font-size: 0.8rem; color: #9ca3af; margin: 0.125rem 0 0; }
    .section-label { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; padding: 0.875rem 1.25rem 0.5rem; }
    .panel-body { padding: 0 1.25rem 0.5rem; }
    .field-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 0.625rem 0; border-bottom: 1px solid #f3f4f6; }
    .field-row:last-child { border-bottom: none; }
    .field-label { font-size: 0.8rem; color: #9ca3af; font-weight: 500; }
    .field-value { font-size: 0.875rem; color: #111827; font-weight: 500; text-align: right; }
    .actions { display: flex; gap: 0.5rem; padding: 1rem 1.25rem; border-top: 1px solid #e5e7eb; }
    .btn-edit { flex: 1; display: inline-flex; align-items: center; justify-content: center; background: #111827; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; text-decoration: none; cursor: pointer; transition: background .15s; }
    .btn-edit:hover { background: #374151; }
    .btn-del { flex: 1; display: inline-flex; align-items: center; justify-content: center; background: #fff; color: #ef4444; border: 1px solid #fecaca; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: background .15s; font-family: inherit; }
    .btn-del:hover { background: #fef2f2; }
    @media (prefers-color-scheme: dark) {
        .show-title { color: #f3f4f6; }
        .show-back:hover { color: #f3f4f6; }
        .panel { background: #111827; border-color: #374151; }
        .panel-top { border-bottom-color: #374151; }
        .panel-name { color: #f3f4f6; }
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
            <h1 class="show-title">Detalhes do cliente</h1>
            <a href="{{ route('cliente.index') }}" class="show-back">
                <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Voltar
            </a>
        </div>
        <div class="panel">
            <div class="panel-top">
                <div class="avatar">{{ strtoupper(substr($cliente->nome, 0, 2)) }}</div>
                <div>
                    <p class="panel-name">{{ $cliente->nome }}</p>
                    <p class="panel-email">{{ $cliente->email ?? '—' }}</p>
                </div>
            </div>

            <div class="section-label">Dados pessoais</div>
            <div class="panel-body">
                <div class="field-row">
                    <span class="field-label">CPF</span>
                    <span class="field-value">{{ $cliente->cpf ?? '—' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Telefone</span>
                    <span class="field-value">{{ $cliente->telefone ?? '—' }}</span>
                </div>
            </div>

            <div class="section-label">Endereço</div>
            <div class="panel-body">
                <div class="field-row">
                    <span class="field-label">CEP</span>
                    <span class="field-value">{{ $cliente->endereco->cep ?? '—' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Rua</span>
                    <span class="field-value">{{ $cliente->endereco->rua ?? '—' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Número</span>
                    <span class="field-value">{{ $cliente->endereco->numero ?? '—' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Bairro</span>
                    <span class="field-value">{{ $cliente->endereco->bairro ?? '—' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Cidade</span>
                    <span class="field-value">{{ $cliente->endereco->cidade ?? '—' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">UF</span>
                    <span class="field-value">{{ $cliente->endereco->uf ?? '—' }}</span>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn-edit">Editar</a>
                <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" style="flex:1;" onsubmit="return confirm('Tem certeza que deseja deletar?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-del" style="width:100%;">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>