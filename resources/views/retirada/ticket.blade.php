<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Retirada #{{ $retirada->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Ticket de Retirada #{{ $retirada->id }}</h1>

    <div class="info">
        <p><strong>Cliente:</strong> {{ $retirada->cliente->nome }}</p>
        <p><strong>Data da Retirada:</strong> {{ $retirada->dataRetirada}}</p>
        <p><strong>Observação:</strong> {{ $retirada->observacao ?? 'Nenhuma observação.' }}</p>
    </div>

    <h2>Produtos Retirados</h2>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($retirada->produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->pivot->quantidade }}</td>
                    <td>R$ {{ number_format($produto->pivot->valorUnitario, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->pivot->quantidade * $produto->pivot->valorUnitario, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="info" style="margin-top: 20px;">
        <p><strong>Total de Produtos:</strong> {{ $retirada->produtos->count() }}</p>
        <p><strong>Valor Total da Retirada:</strong> R$ {{ number_format($retirada->produtos->sum(function ($produto) {
            return $produto->pivot->quantidade * $produto->pivot->valorUnitario;
        }), 2, ',', '.') }}</p>
    </div>
</body>
</html>