<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Estoque Crítico</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #111827; padding: 2rem; }
        .header { border-bottom: 2px solid #111827; padding-bottom: 1rem; margin-bottom: 1.5rem; }
        .header h1 { font-size: 18px; font-weight: bold; }
        .header-sub { font-size: 12px; color: #6b7280; margin-top: 4px; }
        .header-meta { display: flex; justify-content: space-between; font-size: 11px; color: #6b7280; margin-top: 0.5rem; }
        .summary { display: flex; gap: 1rem; margin-bottom: 1.5rem; }
        .summary-card { border: 1px solid #e5e7eb; border-radius: 6px; padding: 0.75rem 1rem; flex: 1; }
        .summary-card .label { font-size: 10px; text-transform: uppercase; letter-spacing: .05em; color: #6b7280; }
        .summary-card .value { font-size: 20px; font-weight: bold; color: #111827; margin-top: 2px; }
        .summary-card.danger { border-color: #fecaca; }
        .summary-card.danger .value { color: #dc2626; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #111827; color: #fff; }
        thead th { padding: 8px 10px; text-align: left; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; }
        tbody tr:nth-child(even) { background: #f9fafb; }
        tbody tr { border-bottom: 1px solid #e5e7eb; }
        tbody td { padding: 8px 10px; }
        .badge-zero { display: inline-block; background: #fef2f2; color: #dc2626; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 20px; }
        .badge-low { display: inline-block; background: #fefce8; color: #ca8a04; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 20px; }
        .alerta { background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px; padding: 0.75rem 1rem; margin-bottom: 1.5rem; font-size: 12px; color: #dc2626; }
        .footer { margin-top: 2rem; padding-top: 0.75rem; border-top: 1px solid #e5e7eb; font-size: 10px; color: #9ca3af; text-align: center; }
        .empty { text-align: center; padding: 3rem; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Estoque Crítico</h1>
        <div class="header-sub">Produtos com estoque igual ou inferior a {{ $limite }} unidades</div>
        <div class="header-meta">
            <span>StockFlow — TADS23</span>
            <span>Gerado em {{ $geradoEm }}</span>
        </div>
    </div>

    @if($produtos->isNotEmpty())
    <div class="alerta">
        Atenção: {{ $produtos->count() }} produto(s) precisam de reposição imediata.
        {{ $produtos->where('estoque', 0)->count() }} estão completamente zerados.
    </div>
    @endif

    <div class="summary">
        <div class="summary-card danger">
            <div class="label">Produtos críticos</div>
            <div class="value">{{ $produtos->count() }}</div>
        </div>
        <div class="summary-card danger">
            <div class="label">Completamente zerados</div>
            <div class="value">{{ $produtos->where('estoque', 0)->count() }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Categorias afetadas</div>
            <div class="value">{{ $produtos->pluck('id_categoria')->unique()->count() }}</div>
        </div>
    </div>

    @if($produtos->isEmpty())
        <div class="empty">Nenhum produto em situação crítica. Estoque saudável!</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Unidade</th>
                    <th>Est. inicial</th>
                    <th>Estoque atual</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->categoria->nome ?? '—' }}</td>
                    <td>{{ $produto->unidade->sigla ?? '—' }}</td>
                    <td>{{ $produto->estoqueInicial ?? '—' }}</td>
                    <td>{{ $produto->estoque }}</td>
                    <td>
                        @if($produto->estoque == 0)
                            <span class="badge-zero">Zerado</span>
                        @else
                            <span class="badge-low">Crítico</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        Sistema de Controle de Estoque &bull; Ana Canestraro &bull; TADS23
    </div>
</body>
</html>