@section('title', 'Produtos')
<x-app-layout>
<style>
    .list-page { padding: 2rem 1.5rem; min-height: 100%; }
    .list-wrap { max-width: 1100px; margin: 0 auto; }
    .list-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .list-title { font-size: 1.125rem; font-weight: 500; margin: 0; color: #111827; }
    .btn-new { display: inline-flex; align-items: center; gap: 0.4rem; background: #111827; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; text-decoration: none; cursor: pointer; transition: background .15s; }
    .btn-new:hover { background: #374151; }
    .search-box { width: 100%; padding: 0.5rem 0.875rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; font-size: 0.875rem; margin-bottom: 1rem; outline: none; background: #fff; color: #111827; }
    .search-box:focus { border-color: #6b7280; }
    .list-table { width: 100%; border-collapse: collapse; }
    .list-table th { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; padding: 0 1rem 0.625rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
    .list-table td { padding: 0.875rem 1rem; font-size: 0.875rem; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    .list-table tr:last-child td { border-bottom: none; }
    .list-table tr:hover td { background: #f9fafb; }
    .prod-img { width: 2.25rem; height: 2.25rem; border-radius: 0.375rem; object-fit: cover; border: 1px solid #e5e7eb; }
    .prod-name { font-weight: 500; color: #111827; }
    .badge-ok { display: inline-block; font-size: 0.7rem; font-weight: 500; padding: 0.2rem 0.55rem; border-radius: 9999px; background: #f0fdf4; color: #16a34a; }
    .badge-warn { display: inline-block; font-size: 0.7rem; font-weight: 500; padding: 0.2rem 0.55rem; border-radius: 9999px; background: #fefce8; color: #ca8a04; }
    .badge-zero { display: inline-block; font-size: 0.7rem; font-weight: 500; padding: 0.2rem 0.55rem; border-radius: 9999px; background: #fef2f2; color: #dc2626; }
    .action-link { font-size: 0.8rem; color: #6b7280; text-decoration: none; padding: 0.25rem 0.5rem; border-radius: 0.375rem; transition: background .15s, color .15s; }
    .action-link:hover { background: #f3f4f6; color: #111827; }
    .action-del { font-size: 0.8rem; color: #ef4444; background: none; border: none; cursor: pointer; padding: 0.25rem 0.5rem; border-radius: 0.375rem; transition: background .15s; font-family: inherit; }
    .action-del:hover { background: #fef2f2; }
    .panel { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
    @media (prefers-color-scheme: dark) {
        .list-title { color: #f3f4f6; }
        .btn-new { background: #374151; }
        .btn-new:hover { background: #4b5563; }
        .search-box { background: #1f2937; border-color: #374151; color: #f3f4f6; }
        .search-box:focus { border-color: #6b7280; }
        .list-table th { color: #6b7280; border-bottom-color: #374151; }
        .list-table td { color: #d1d5db; border-bottom-color: #1f2937; }
        .list-table tr:hover td { background: #1f2937; }
        .prod-name { color: #f3f4f6; }
        .prod-img { border-color: #374151; }
        .action-link { color: #9ca3af; }
        .action-link:hover { background: #374151; color: #f3f4f6; }
        .action-del:hover { background: #450a0a; }
        .panel { background: #111827; border-color: #374151; }
    }
</style>
<div class="list-page">
    <div class="list-wrap">
        <div class="list-header">
            <h1 class="list-title">Produtos</h1>
            <a href="{{ route('produto.create') }}" class="btn-new">
                <svg style="width:.875rem;height:.875rem;stroke:currentColor;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Novo Produto
            </a>
        </div>

        @if(session('mensagem'))
            <p style="font-size:.875rem; color:#6b7280; margin-bottom:1rem;">{{ session('mensagem') }}</p>
        @endif

        <div class="panel">
            <div style="padding: 0.875rem 1rem; border-bottom: 1px solid #e5e7eb;">
                <input class="search-box" style="margin:0;" oninput="filtrar(this.value)" type="text" placeholder="Buscar produto...">
            </div>
            <table class="list-table">
                <thead>
                    <tr>
                        <th style="width:3rem;"></th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Unidade</th>
                        <th>Valor</th>
                        <th>Estoque</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produtos as $produto)
                    <tr class="produto-row">
                        <td>
                            <img src="{{ asset('img/produtos/'.$produto->imagem) }}" alt="{{ $produto->nome }}" class="prod-img">
                        </td>
                        <td><span class="prod-name nome">{{ $produto->nome }}</span></td>
                        <td>{{ $produto->categoria->nome ?? '—' }}</td>
                        <td>{{ $produto->unidade->sigla ?? '—' }}</td>
                        <td>R$ {{ number_format($produto->valorUnitario, 2, ',', '.') }}</td>
                        <td>
                            @if($produto->estoque == 0)
                                <span class="badge-zero">0 em estoque</span>
                            @elseif($produto->estoque <= 5)
                                <span class="badge-warn">{{ $produto->estoque }}</span>
                            @else
                                <span class="badge-ok">{{ $produto->estoque }}</span>
                            @endif
                        </td>
                        <td style="text-align:right; white-space:nowrap;">
                            <a href="{{ route('produto.show', $produto->id) }}" class="action-link">Ver</a>
                            <a href="{{ route('produto.edit', $produto->id) }}" class="action-link">Editar</a>
                            <form action="{{ route('produto.destroy', $produto->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja deletar?');">
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
    document.querySelectorAll('.produto-row').forEach(row => {
        const nome = row.querySelector('.nome').textContent.toLowerCase();
        row.style.display = nome.includes(valor.toLowerCase()) ? '' : 'none';
    });
}
</script>
</x-app-layout>