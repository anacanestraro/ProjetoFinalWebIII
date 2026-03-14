@section('title', 'Dashboard')

<x-app-layout>
<style>
    .dash-page { min-height: 100%; padding: 2.5rem 1.5rem; }
    .dash-wrap { max-width: 1100px; margin: 0 auto; }

    .dash-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1.25rem;
        text-decoration: none;
        display: block;
        transition: border-color .15s;
    }
    .dash-panel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }
    .dash-panel-row {
        border-bottom: 1px solid #f3f4f6;
    }
    .dash-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.45rem 0.875rem;
        font-size: 0.875rem;
        color: #374151;
        text-decoration: none;
        transition: border-color .15s;
    }
    .dash-title { color: #111827; }
    .dash-muted { color: #9ca3af; }
    .dash-item-title { color: #111827; }
    .dash-panel-heading { color: #374151; }
    .dash-footer-border { border-bottom: 1px solid #f3f4f6; }

    @media (prefers-color-scheme: dark) {
        .dash-card {
            background: #1f2937;
            border-color: #374151;
        }
        .dash-panel {
            background: #1f2937;
            border-color: #374151;
        }
        .dash-panel-row { border-bottom-color: #374151; }
        .dash-action-btn {
            background: #1f2937;
            border-color: #374151;
            color: #d1d5db;
        }
        .dash-title { color: #f3f4f6; }
        .dash-muted { color: #6b7280; }
        .dash-item-title { color: #f3f4f6; }
        .dash-panel-heading { color: #e5e7eb; }
        .dash-footer-border { border-bottom-color: #374151; }
    }
</style>

    <div class="dash-page">
        <div class="dash-wrap">

            {{-- Cabeçalho --}}
            <div style="margin-bottom:2rem;">
                <h1 class="dash-title" style="font-size:1.25rem; font-weight:500; margin:0;">
                    Olá, {{ Auth::user()->name }} 👋
                </h1>
                <p class="dash-muted" style="font-size:0.875rem; margin-top:0.25rem;">
                    Aqui está um resumo do seu estoque hoje.
                </p>
            </div>

            {{-- Cards de resumo --}}
            <div style="display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:0.75rem; margin-bottom:1.5rem;">

                <a href="{{ route('produto.index') }}" class="dash-card">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.75rem;">
                        <span class="dash-muted" style="font-size:0.7rem; font-weight:500; text-transform:uppercase; letter-spacing:.06em;">Produtos</span>
                        <div style="width:2rem; height:2rem; border-radius:0.5rem; background:#eff6ff; display:flex; align-items:center; justify-content:center;">
                            <svg style="width:1rem;height:1rem;stroke:#3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                        </div>
                    </div>
                    <p class="dash-title" style="font-size:1.875rem; font-weight:500; line-height:1; margin:0;">{{ $totalProdutos }}</p>
                    @if($semEstoque > 0)
                        <p style="font-size:0.75rem; color:#ef4444; margin-top:0.25rem;">{{ $semEstoque }} sem estoque</p>
                    @else
                        <p style="font-size:0.75rem; color:#22c55e; margin-top:0.25rem;">Todos com estoque</p>
                    @endif
                </a>

                <a href="{{ route('cliente.index') }}" class="dash-card">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.75rem;">
                        <span class="dash-muted" style="font-size:0.7rem; font-weight:500; text-transform:uppercase; letter-spacing:.06em;">Clientes</span>
                        <div style="width:2rem; height:2rem; border-radius:0.5rem; background:#f5f3ff; display:flex; align-items:center; justify-content:center;">
                            <svg style="width:1rem;height:1rem;stroke:#8b5cf6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                    </div>
                    <p class="dash-title" style="font-size:1.875rem; font-weight:500; line-height:1; margin:0;">{{ $totalClientes }}</p>
                    <p class="dash-muted" style="font-size:0.75rem; margin-top:0.25rem;">cadastrados</p>
                </a>

                <a href="{{ route('retirada.index') }}" class="dash-card">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.75rem;">
                        <span class="dash-muted" style="font-size:0.7rem; font-weight:500; text-transform:uppercase; letter-spacing:.06em;">Retiradas</span>
                        <div style="width:2rem; height:2rem; border-radius:0.5rem; background:#fdf2f8; display:flex; align-items:center; justify-content:center;">
                            <svg style="width:1rem;height:1rem;stroke:#ec4899;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                    </div>
                    <p class="dash-title" style="font-size:1.875rem; font-weight:500; line-height:1; margin:0;">{{ $totalRetiradas }}</p>
                    <p class="dash-muted" style="font-size:0.75rem; margin-top:0.25rem;">no total</p>
                </a>

                <a href="{{ route('categoria.index') }}" class="dash-card">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.75rem;">
                        <span class="dash-muted" style="font-size:0.7rem; font-weight:500; text-transform:uppercase; letter-spacing:.06em;">Categorias</span>
                        <div style="width:2rem; height:2rem; border-radius:0.5rem; background:#f0fdf4; display:flex; align-items:center; justify-content:center;">
                            <svg style="width:1rem;height:1rem;stroke:#14b8a6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </div>
                    </div>
                    <p class="dash-title" style="font-size:1.875rem; font-weight:500; line-height:1; margin:0;">{{ $totalCategorias }}</p>
                    <p class="dash-muted" style="font-size:0.75rem; margin-top:0.25rem;">cadastradas</p>
                </a>

            </div>

            {{-- Painéis --}}
            <div style="display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:1.5rem; margin-bottom:1.5rem;">

                <div class="dash-panel">
                    <div class="dash-footer-border" style="display:flex; align-items:center; justify-content:space-between; padding:0.75rem 1.25rem;">
                        <h2 class="dash-panel-heading" style="font-size:0.875rem; font-weight:500; margin:0;">Últimas retiradas</h2>
                        <a href="{{ route('retirada.index') }}" class="dash-muted" style="font-size:0.75rem; text-decoration:none;">Ver todas →</a>
                    </div>
                    @if($ultimasRetiradas->isEmpty())
                        <div class="dash-muted" style="padding:2rem; text-align:center; font-size:0.875rem;">
                            Nenhuma retirada registrada ainda.
                        </div>
                    @else
                        @foreach($ultimasRetiradas as $retirada)
                        <div class="dash-panel-row" style="display:flex; align-items:center; justify-content:space-between; padding:0.75rem 1.25rem;">
                            <div>
                                <p class="dash-item-title" style="font-size:0.875rem; font-weight:500; margin:0;">{{ $retirada->cliente->nome ?? 'Cliente removido' }}</p>
                                <p class="dash-muted" style="font-size:0.75rem; margin:0.125rem 0 0;">{{ $retirada->produtos->count() }} produto(s)</p>
                            </div>
                            <div style="display:flex; align-items:center; gap:0.5rem;">
                                <span class="dash-muted" style="font-size:0.75rem;">{{ $retirada->created_at->diffForHumans() }}</span>
                                <a href="{{ route('retirada.ticket', $retirada->id) }}" style="font-size:0.75rem; background:#eff6ff; color:#3b82f6; padding:0.2rem 0.5rem; border-radius:0.375rem; text-decoration:none; font-weight:500;">Ticket</a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <div class="dash-panel">
                    <div class="dash-footer-border" style="display:flex; align-items:center; justify-content:space-between; padding:0.75rem 1.25rem;">
                        <h2 class="dash-panel-heading" style="font-size:0.875rem; font-weight:500; margin:0;">Estoque crítico</h2>
                        <a href="{{ route('produtosSemEstoque') }}" class="dash-muted" style="font-size:0.75rem; text-decoration:none;">Ver relatório →</a>
                    </div>
                    @if($produtosCriticos->isEmpty())
                        <div class="dash-muted" style="padding:2rem; text-align:center; font-size:0.875rem;">
                            Nenhum produto com estoque crítico. 🎉
                        </div>
                    @else
                        @foreach($produtosCriticos as $produto)
                        <div class="dash-panel-row" style="display:flex; align-items:center; justify-content:space-between; padding:0.75rem 1.25rem;">
                            <div style="display:flex; align-items:center; gap:0.75rem;">
                                <img src="{{ asset('img/produtos/'.$produto->imagem) }}" alt="{{ $produto->nome }}"
                                     style="width:2rem; height:2rem; border-radius:0.375rem; object-fit:cover; border:1px solid #e5e7eb;">
                                <div>
                                    <p class="dash-item-title" style="font-size:0.875rem; font-weight:500; margin:0;">{{ $produto->nome }}</p>
                                    <p class="dash-muted" style="font-size:0.75rem; margin:0.125rem 0 0;">{{ $produto->categoria->nome ?? '—' }}</p>
                                </div>
                            </div>
                            @if($produto->estoque == 0)
                                <span style="font-size:0.75rem; font-weight:500; padding:0.2rem 0.6rem; border-radius:9999px; background:#fef2f2; color:#ef4444;">0 em estoque</span>
                            @else
                                <span style="font-size:0.75rem; font-weight:500; padding:0.2rem 0.6rem; border-radius:9999px; background:#fefce8; color:#ca8a04;">{{ $produto->estoque }} em estoque</span>
                            @endif
                        </div>
                        @endforeach
                    @endif
                </div>

            </div>

            {{-- Ações rápidas --}}
            <div style="margin-bottom:2rem;">
                <p class="dash-muted" style="font-size:0.7rem; font-weight:500; text-transform:uppercase; letter-spacing:.06em; margin-bottom:0.75rem;">Ações rápidas</p>
                <div style="display:flex; flex-wrap:wrap; gap:0.5rem;">
                    <a href="{{ route('produto.create') }}" class="dash-action-btn">
                        <svg style="width:0.875rem;height:0.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Novo Produto
                    </a>
                    <a href="{{ route('retirada.create') }}" class="dash-action-btn">
                        <svg style="width:0.875rem;height:0.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Nova Retirada
                    </a>
                    <a href="{{ route('cliente.create') }}" class="dash-action-btn">
                        <svg style="width:0.875rem;height:0.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Novo Cliente
                    </a>
                    <a href="{{ route('retiradasPorCliente') }}" class="dash-action-btn">
                        <svg style="width:0.875rem;height:0.875rem;stroke:currentColor;flex-shrink:0;" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Relatório de Retiradas
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>