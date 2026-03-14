@section('title', 'Editar Produto')
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
    .field-label { font-size: 0.8rem; font-weight: 500; color: #374151; display: block; margin-bottom: 0.375rem; }
    .field-input { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; color: #111827; background: #fff; outline: none; transition: border-color .15s; box-sizing: border-box; }
    .field-input:focus { border-color: #6b7280; }
    .field-select { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; color: #111827; background: #fff; outline: none; transition: border-color .15s; box-sizing: border-box; cursor: pointer; }
    .field-select:focus { border-color: #6b7280; }
    .field-error { font-size: 0.75rem; color: #ef4444; margin-top: 0.25rem; }
    .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .img-preview-wrap { border: 1px solid #e5e7eb; border-radius: 0.5rem; overflow: hidden; background: #f9fafb; display: flex; align-items: center; justify-content: center; padding: 1rem; }
    .img-preview { max-height: 160px; max-width: 100%; object-fit: contain; display: block; margin: 0 auto; }
    .file-input { font-size: 0.875rem; color: #6b7280; }
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
        .img-preview-wrap { background: #1f2937; border-color: #374151; }
        .panel-footer { border-top-color: #374151; }
        .btn-save { background: #374151; } .btn-save:hover { background: #4b5563; }
        .btn-cancel { background: transparent; color: #d1d5db; border-color: #374151; }
    }
</style>
<div class="form-page">
    <div class="form-wrap">
        <div class="form-header">
            <h1 class="form-title">Editar produto</h1>
            <a href="{{ route('produto.index') }}" class="form-back">
                <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Voltar
            </a>
        </div>
        <div class="panel">
            <form action="{{ route('produto.update', $produto) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="panel-body">

                    <div>
                        <label class="field-label">Imagem</label>
                        <div class="img-preview-wrap" style="margin-bottom: 0.5rem;">
                            <img id="imgPreview" src="{{ asset('img/produtos/'.$produto->imagem) }}" alt="{{ $produto->nome }}" class="img-preview">
                        </div>
                        <input class="file-input" type="file" name="imagem" accept="image/*" onchange="previewImagem(event)">
                        @error('imagem') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="field-label">Nome</label>
                        <input class="field-input" type="text" name="nome" value="{{ old('nome', $produto->nome) }}">
                        @error('nome') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="field-label">Descrição</label>
                        <input class="field-input" type="text" name="descricao" value="{{ old('descricao', $produto->descricao) }}">
                        @error('descricao') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field-grid">
                        <div>
                            <label class="field-label">Valor unitário</label>
                            <input class="field-input" type="text" name="valorUnitario" value="{{ old('valorUnitario', $produto->valorUnitario) }}">
                            @error('valorUnitario') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="field-label">Estoque</label>
                            <input class="field-input" type="number" name="estoque" value="{{ old('estoque', $produto->estoque) }}">
                            @error('estoque') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="field-grid">
                        <div>
                            <label class="field-label">Unidade de medida</label>
                            <select class="field-select" name="id_unidade">
                                @foreach($unidades as $unidade)
                                    <option value="{{ $unidade->id }}" {{ $produto->id_unidade == $unidade->id ? 'selected' : '' }}>
                                        {{ $unidade->sigla }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_unidade') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="field-label">Categoria</label>
                            <select class="field-select" name="id_categoria">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $produto->id_categoria == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_categoria') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-save">Salvar alterações</button>
                    <a href="{{ route('produto.show', $produto->id) }}" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function previewImagem(event) {
    const file = event.target.files[0];
    if (file) {
        document.getElementById('imgPreview').src = URL.createObjectURL(file);
    }
}
</script>
</x-app-layout>