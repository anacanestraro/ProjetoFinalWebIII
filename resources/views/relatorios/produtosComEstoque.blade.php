<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos Com Estoque</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #111827; padding: 2rem; }

        .header { border-bottom: 2px solid #111827; padding-bottom: 1rem; margin-bottom: 1.5rem; }
        .header h1 { font-size: 18px; font-weight: bold; margin-bottom: 0.25rem; }
        .header-meta { display: flex; justify-content: space-between; font-size: 11px; color: #6b7280; margin-top: 0.5rem; }

        .summary { display: flex; gap: 1rem; margin-bottom: 1.5rem; }
        .summary-card { border: 1px solid #e5e7eb; border-radius: 6px; padding: 0.75rem 1rem; flex: 1; }
        .summary-card .label { font-size: 10px; text-transform: uppercase; letter-spacing: .05em; color: #6b7280; }
        .summary-card .value { font-size: 20px; font-weight: bold; color: #111827; margin-top: 2px; }

        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #111827; color: #fff; }
        thead th { padding: 8px 10px; text-align: left; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; }
        tbody tr:nth-child(even) { background: #f9fafb; }
        tbody tr { border-bottom: 1px solid #e5e7eb; }
        tbody td { padding: 8px 10px; }

        .badge-ok { display: inline-block; background: #f0fdf4; color: #16a34a; font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 20px; }
        .badge-low { display: inline-block; background: #fefce8; color: #ca8a04; font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 20px; }

        .footer { margin-top: 2rem; padding-top: 0.75rem; border-top: 1px solid #e5e7eb; font-size: 10px; color: #9ca3af; text-align: center; }
        .empty { text-align: center; padding: 3rem; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Produtos Com Estoque</h1>
        <div class="header-meta">
            <span>StockFlow — TADS23</span>
            <span>Gerado em {{ $geradoEm }}</span>
        </div>
    </div>

    <div class="summary">
        <div class="summary-card">
            <div class="label">Total de produtos</div>
            <div class="value">{{ $produtos->count() }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Estoque crítico (≤ 5)</div>
            <div class="value">{{ $produtos->where('estoque', '<=', 5)->count() }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Total em estoque</div>
            <div class="value">{{ $produtos->sum('estoque') }}</div>
        </div>
    </div>

    @if($produtos->isEmpty())
        <div class="empty">Nenhum produto com estoque encontrado.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Unidade</th>
                    <th>Valor unitário</th>
                    <th>Estoque</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->categoria->nome ?? '—' }}</td>
                    <td>{{ $produto->unidade->sigla ?? '—' }}</td>
                    <td>R$ {{ number_format($produto->valorUnitario, 2, ',', '.') }}</td>
                    <td>{{ $produto->estoque }}</td>
                    <td>
                        @if($produto->estoque <= 5)
                            <span class="badge-low">Crítico</span>
                        @else
                            <span class="badge-ok">Normal</span>
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