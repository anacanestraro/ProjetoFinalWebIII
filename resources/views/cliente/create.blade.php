@section('title', 'Novo Cliente')
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
    .field-error { font-size: 0.75rem; color: #ef4444; margin-top: 0.25rem; }
    .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
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
        .field-input:focus { border-color: #6b7280; }
        .panel-footer { border-top-color: #374151; }
        .btn-save { background: #374151; } .btn-save:hover { background: #4b5563; }
        .btn-cancel { background: transparent; color: #d1d5db; border-color: #374151; }
    }
</style>
<div class="form-page">
    <div class="form-wrap">
        <div class="form-header">
            <h1 class="form-title">Novo cliente</h1>
            <a href="{{ route('cliente.index') }}" class="form-back">
                <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Voltar
            </a>
        </div>
        <div class="panel">
            <form action="{{ route('cliente.store') }}" method="POST">
                @csrf

                <div class="section-label">Dados pessoais</div>
                <div class="panel-body">
                    <div>
                        <label class="field-label">Nome</label>
                        <input class="field-input" type="text" name="nome" value="{{ old('nome') }}" autofocus>
                        @error('nome') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="field-label">E-mail</label>
                        <input class="field-input" type="email" name="email" value="{{ old('email') }}">
                        @error('email') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="field-grid">
                        <div>
                            <label class="field-label">CPF</label>
                            <input class="field-input" type="text" name="cpf" value="{{ old('cpf') }}">
                            @error('cpf') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="field-label">Telefone</label>
                            <input class="field-input" type="text" name="telefone" value="{{ old('telefone') }}">
                            @error('telefone') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="section-label">Endereço</div>
                <div class="panel-body">
                    <div class="field-grid">
                        <div>
                            <label class="field-label">CEP</label>
                            <input class="field-input" type="text" name="cep" id="cep" value="{{ old('cep') }}" onblur="pesquisacep(this.value)">
                            @error('cep') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="field-label">Número</label>
                            <input class="field-input" type="text" name="numero" id="numero" value="{{ old('numero') }}">
                            @error('numero') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="field-label">Rua</label>
                        <input class="field-input" type="text" name="rua" id="rua" value="{{ old('rua') }}">
                        @error('rua') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="field-grid">
                        <div>
                            <label class="field-label">Bairro</label>
                            <input class="field-input" type="text" name="bairro" id="bairro" value="{{ old('bairro') }}">
                            @error('bairro') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="field-label">Cidade</label>
                            <input class="field-input" type="text" name="cidade" id="cidade" value="{{ old('cidade') }}">
                            @error('cidade') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div style="max-width: 120px;">
                        <label class="field-label">UF</label>
                        <input class="field-input" type="text" name="uf" id="uf" maxlength="2" value="{{ old('uf') }}">
                        @error('uf') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="panel-footer">
                    <button type="submit" class="btn-save">Cadastrar</button>
                    <a href="{{ route('cliente.index') }}" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/js/cep.js"></script>
</x-app-layout>