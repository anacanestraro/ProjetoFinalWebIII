<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Retiradas por Cliente</title>
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

        .cliente-block { margin-bottom: 2rem; page-break-inside: avoid; }
        .cliente-header { background: #111827; color: #fff; padding: 8px 10px; border-radius: 4px 4px 0 0; display: flex; justify-content: space-between; align-items: center; }
        .cliente-header .nome { font-size: 13px; font-weight: bold; }
        .cliente-header .total { font-size: 11px; }

        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #f3f4f6; }
        thead th { padding: 7px 10px; text-align: left; font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: #6b7280; border-bottom: 1px solid #e5e7eb; }
        tbody tr { border-bottom: 1px solid #f3f4f6; }
        tbody tr:last-child { border-bottom: 1px solid #e5e7eb; }
        tbody td { padding: 7px 10px; }

        .total-row { background: #f9fafb; font-weight: bold; }
        .footer { margin-top: 2rem; padding-top: 0.75rem; border-top: 1px solid #e5e7eb; font-size: 10px; color: #9ca3af; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Retiradas por Cliente</h1>
        <div class="header-meta">
            <span>StockFlow — TADS23</span>
            <span>Gerado em {{ $geradoEm }}</span>
        </div>
    </div>

    <div class="summary">
        <div class="summary-card">
            <div class="label">Clientes com retiradas</div>
            <div class="value">{{ $clientes->count() }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Total de retiradas</div>
            <div class="value">{{ $clientes->sum(fn($c) => $c->retiradas->count()) }}</div>
        </div>
    </div>

    @foreach($clientes as $cliente)
    @php
        $totalCliente = 0;
        foreach($cliente->retiradas as $retirada) {
            foreach($retirada->produtos as $produto) {
                $totalCliente += $produto->valorUnitario * $produto->pivot->quantidade;
            }
        }
    @endphp
    <div class="cliente-block">
        <div class="cliente-header">
            <span class="nome">{{ $cliente->nome }}</span>
            <span class="total">Total gasto: R$ {{ number_format($totalCliente, 2, ',', '.') }}</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Unidade</th>
                    <th>Qtd.</th>
                    <th>Valor unit.</th>
                    <th>Total</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cliente->retiradas as $retirada)
                    @foreach($retirada->produtos as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->categoria->nome ?? '—' }}</td>
                        <td>{{ $produto->unidade->sigla ?? '—' }}</td>
                        <td>{{ $produto->pivot->quantidade }}</td>
                        <td>R$ {{ number_format($produto->valorUnitario, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($produto->valorUnitario * $produto->pivot->quantidade, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($retirada->dataRetirada)->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                @endforeach
                <tr class="total-row">
                    <td colspan="5">Total do cliente</td>
                    <td>R$ {{ number_format($totalCliente, 2, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach

    <div class="footer">
        Sistema de Controle de Estoque &bull; Ana Canestraro &bull; TADS23
    </div>
</body>
</html>