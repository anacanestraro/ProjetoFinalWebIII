@section('title', 'Categorias')
<x-app-layout>
<style>
    .list-page { padding: 2rem 1.5rem; min-height: 100%; }
    .list-wrap { max-width: 1100px; margin: 0 auto; }
    .list-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .list-title { font-size: 1.125rem; font-weight: 500; margin: 0; color: #111827; }
    .btn-new { display: inline-flex; align-items: center; gap: 0.4rem; background: #111827; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; text-decoration: none; cursor: pointer; transition: background .15s; }
    .btn-new:hover { background: #374151; }
    .search-box { width: 100%; padding: 0.5rem 0.875rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; font-size: 0.875rem; margin: 0; outline: none; background: #fff; color: #111827; }
    .search-box:focus { border-color: #6b7280; }
    .list-table { width: 100%; border-collapse: collapse; }
    .list-table th { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; padding: 0 1rem 0.625rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
    .list-table td { padding: 0.875rem 1rem; font-size: 0.875rem; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    .list-table tr:last-child td { border-bottom: none; }
    .list-table tr:hover td { background: #f9fafb; }
    .item-name { font-weight: 500; color: #111827; }
    .action-link { font-size: 0.8rem; color: #6b7280; text-decoration: none; padding: 0.25rem 0.5rem; border-radius: 0.375rem; transition: background .15s, color .15s; }
    .action-link:hover { background: #f3f4f6; color: #111827; }
    .action-del { font-size: 0.8rem; color: #ef4444; background: none; border: none; cursor: pointer; padding: 0.25rem 0.5rem; border-radius: 0.375rem; transition: background .15s; font-family: inherit; }
    .action-del:hover { background: #fef2f2; }
    .panel { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
    @media (prefers-color-scheme: dark) {
        .list-title { color: #f3f4f6; }
        .btn-new { background: #374151; } .btn-new:hover { background: #4b5563; }
        .search-box { background: #1f2937; border-color: #374151; color: #f3f4f6; }
        .list-table th { color: #6b7280; border-bottom-color: #374151; }
        .list-table td { color: #d1d5db; border-bottom-color: #1f2937; }
        .list-table tr:hover td { background: #1f2937; }
        .item-name { color: #f3f4f6; }
        .action-link { color: #9ca3af; } .action-link:hover { background: #374151; color: #f3f4f6; }
        .action-del:hover { background: #450a0a; }
        .panel { background: #111827; border-color: #374151; }
    }
</style>
<div class="list-page">
    <div class="list-wrap">
        <div class="list-header">
            <h1 class="list-title">Categorias</h1>
            <a href="{{ route('categoria.create') }}" class="btn-new">
                <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nova Categoria
            </a>
        </div>
        <div class="panel">
            <div style="padding: 0.875rem 1rem; border-bottom: 1px solid #e5e7eb;">
                <input class="search-box" oninput="filtrar(this.value)" type="text" placeholder="Buscar categoria...">
            </div>
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Produtos</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                    <tr class="categoria-row">
                        <td><span class="item-name nome">{{ $categoria->nome }}</span></td>
                        <td>{{ $categoria->descricao ?? '—' }}</td>
                        <td>{{ $categoria->produtos->count() }}</td>
                        <td style="text-align:right; white-space:nowrap;">
                            <a href="{{ route('categoria.show', $categoria->id) }}" class="action-link">Ver</a>
                            <a href="{{ route('categoria.edit', $categoria->id) }}" class="action-link">Editar</a>
                            <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja deletar?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-del">Deletar</button>
                            </form>
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
    document.querySelectorAll('.categoria-row').forEach(row => {
        const nome = row.querySelector('.nome').textContent.toLowerCase();
        row.style.display = nome.includes(valor.toLowerCase()) ? '' : 'none';
    });
}
</script>
</x-app-layout>