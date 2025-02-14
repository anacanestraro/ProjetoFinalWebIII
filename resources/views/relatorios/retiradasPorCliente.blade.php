<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Retiradas por Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Retiradas por Cliente</h1>
    
    @foreach($clientes as $cliente)
        <h2>Cliente: {{ $cliente->nome }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome do Produto</th>
                    <th>Unidade</th>
                    <th>Categoria</th>
                    <th>Quantidade Retirada</th>
                    <th>Data da Retirada</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cliente->retiradas as $retirada)
                    @foreach($retirada->produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->unidade->sigla }}</td>
                            <td>{{ $produto->categoria->nome }}</td>
                            <td>{{ $produto->pivot->quantidade }}</td>
                            <td>{{ $retirada->dataRetirada }}</td>
                            <td>R$ {{ number_format($produto->valorUnitario * $produto->pivot->quantidade, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
