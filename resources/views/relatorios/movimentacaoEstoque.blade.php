<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Movimentação de Estoque</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #111827; padding: 2rem; }
        .header { border-bottom: 2px solid #111827; padding-bottom: 1rem; margin-bottom: 1.5rem; }
        .header h1 { font-size: 18px; font-weight: bold; }
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
        .bar-wrap { background: #e5e7eb; border-radius: 4px; height: 8px; width: 100px; display: inline-block; vertical-align: middle; }
        .bar-fill { background: #111827; border-radius: 4px; height: 8px; }
        .bar-fill-high { background: #dc2626; }
        .pct { font-size: 11px; color: #6b7280; margin-left: 4px; }
        .footer { margin-top: 2rem; padding-top: 0.75rem; border-top: 1px solid #e5e7eb; font-size: 10px; color: #9ca3af; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Movimentação de Estoque</h1>
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
            <div class="label">Total retirado</div>
            <div class="value">{{ $produtos->sum('totalRetirado') }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Em estoque agora</div>
            <div class="value">{{ $produtos->sum('estoque') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Unid.</th>
                <th>Est. inicial</th>
                <th>Retirado</th>
                <th>Em estoque</th>
                <th>Consumo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
            @php $pct = min($produto->percentualConsumido, 100); @endphp
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->categoria->nome ?? '—' }}</td>
                <td>{{ $produto->unidade->sigla ?? '—' }}</td>
                <td>{{ $produto->estoqueInicial ?? '—' }}</td>
                <td>{{ $produto->totalRetirado }}</td>
                <td>{{ $produto->estoque }}</td>
                <td>
                    <div class="bar-wrap">
                        <div class="{{ $pct >= 80 ? 'bar-fill bar-fill-high' : 'bar-fill' }}" style="width: {{ $pct }}%;"></div>
                    </div>
                    <span class="pct">{{ $produto->percentualConsumido }}%</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Sistema de Controle de Estoque &bull; Ana Canestraro &bull; TADS23
    </div>
</body>
</html>