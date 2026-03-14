<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Retiradas por Período</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #111827; padding: 2rem; }
        .header { border-bottom: 2px solid #111827; padding-bottom: 1rem; margin-bottom: 1.5rem; }
        .header h1 { font-size: 18px; font-weight: bold; }
        .header-sub { font-size: 13px; color: #6b7280; margin-top: 4px; }
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
        .total-row { background: #f3f4f6 !important; font-weight: bold; border-top: 2px solid #e5e7eb; }
        .footer { margin-top: 2rem; padding-top: 0.75rem; border-top: 1px solid #e5e7eb; font-size: 10px; color: #9ca3af; text-align: center; }
        .empty { text-align: center; padding: 3rem; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Retiradas por Período</h1>
        <div class="header-sub">{{ $dataInicioBR }} até {{ $dataFimBR }}</div>
        <div class="header-meta">
            <span>StockFlow — TADS23</span>
            <span>Gerado em {{ $geradoEm }}</span>
        </div>
    </div>

    <div class="summary">
        <div class="summary-card">
            <div class="label">Retiradas no período</div>
            <div class="value">{{ $retiradas->count() }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Clientes atendidos</div>
            <div class="value">{{ $retiradas->pluck('id_cliente')->unique()->count() }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Valor total</div>
            <div class="value" style="font-size:14px;">R$ {{ number_format($totalGeral, 2, ',', '.') }}</div>
        </div>
    </div>

    @if($retiradas->isEmpty())
        <div class="empty">Nenhuma retirada encontrada neste período.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Qtd.</th>
                    <th>Valor unit.</th>
                    <th>Total</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($retiradas as $retirada)
                    @foreach($retirada->produtos as $produto)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($retirada->dataRetirada)->format('d/m/Y') }}</td>
                        <td>{{ $retirada->cliente->nome ?? '—' }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->pivot->quantidade }}</td>
                        <td>R$ {{ number_format($produto->valorUnitario, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($produto->valorUnitario * $produto->pivot->quantidade, 2, ',', '.') }}</td>
                        <td>{{ $retirada->observacao ?? '—' }}</td>
                    </tr>
                    @endforeach
                @endforeach
                <tr class="total-row">
                    <td colspan="5">Total geral do período</td>
                    <td>R$ {{ number_format($totalGeral, 2, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @endif

    <div class="footer">
        Sistema de Controle de Estoque &bull; Ana Canestraro &bull; TADS23
    </div>
</body>
</html>