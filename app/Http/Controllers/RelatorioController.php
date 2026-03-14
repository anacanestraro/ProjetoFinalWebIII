<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Retirada;

class RelatorioController extends Controller
{
    public function produtosSemEstoque()
    {
        $produtos = Produto::with(['categoria', 'unidade'])
            ->where('estoque', 0)
            ->orWhereNull('estoque')
            ->orderBy('nome')
            ->get();

        $geradoEm = now()->format('d/m/Y H:i');
        $pdf = Pdf::loadView('relatorios.produtosSemEstoque', compact('produtos', 'geradoEm'));
        return $pdf->stream('produtos-sem-estoque.pdf');
    }

    public function produtosComEstoque()
    {
        $produtos = Produto::with(['categoria', 'unidade'])
            ->where('estoque', '>', 0)
            ->orderBy('nome')
            ->get();

        $geradoEm = now()->format('d/m/Y H:i');
        $pdf = Pdf::loadView('relatorios.produtosComEstoque', compact('produtos', 'geradoEm'));
        return $pdf->stream('produtos-com-estoque.pdf');
    }

    public function retiradasPorCliente()
    {
        $clientes = Cliente::whereHas('retiradas')
            ->with(['retiradas' => function ($q) {
                $q->orderByDesc('dataRetirada');
            }, 'retiradas.produtos'])
            ->orderBy('nome')
            ->get();

        $geradoEm = now()->format('d/m/Y H:i');
        $pdf = Pdf::loadView('relatorios.retiradasPorCliente', compact('clientes', 'geradoEm'));
        return $pdf->stream('retiradas-por-cliente.pdf');
    }

    public function movimentacaoEstoque()
    {
        $produtos = Produto::with(['unidade', 'categoria', 'retiradas'])
            ->orderBy('nome')
            ->get()
            ->map(function ($produto) {
                $totalRetirado = $produto->retiradas->sum(fn($r) => $r->pivot->quantidade);
                $produto->totalRetirado = $totalRetirado;
                $produto->percentualConsumido = $produto->estoqueInicial > 0
                    ? round(($totalRetirado / $produto->estoqueInicial) * 100, 1)
                    : 0;
                return $produto;
            })
            ->sortByDesc('totalRetirado');

        $geradoEm = now()->format('d/m/Y H:i');
        $pdf = Pdf::loadView('relatorios.movimentacaoEstoque', compact('produtos', 'geradoEm'));
        return $pdf->stream('movimentacao-estoque.pdf');
    }

    public function retiradasPorPeriodo(Request $request)
    {
        $dataInicio = $request->input('dataInicio', now()->startOfMonth()->format('Y-m-d'));
        $dataFim    = $request->input('dataFim', now()->format('Y-m-d'));

        $retiradas = Retirada::with(['cliente', 'produtos'])
            ->whereBetween('dataRetirada', [$dataInicio . ' 00:00:00', $dataFim . ' 23:59:59'])
            ->orderByDesc('dataRetirada')
            ->get();

        $totalGeral = $retiradas->sum(function ($retirada) {
            return $retirada->produtos->sum(fn($p) => $p->valorUnitario * $p->pivot->quantidade);
        });

        $geradoEm   = now()->format('d/m/Y H:i');
        $dataInicioBR = \Carbon\Carbon::parse($dataInicio)->format('d/m/Y');
        $dataFimBR    = \Carbon\Carbon::parse($dataFim)->format('d/m/Y');

        $pdf = Pdf::loadView('relatorios.retiradasPorPeriodo', compact(
            'retiradas', 'totalGeral', 'geradoEm', 'dataInicioBR', 'dataFimBR'
        ));
        return $pdf->stream('retiradas-por-periodo.pdf');
    }

    public function estoqueCritico()
    {
        $limite = 5;
        $produtos = Produto::with(['categoria', 'unidade'])
            ->where('estoque', '<=', $limite)
            ->orderBy('estoque')
            ->orderBy('nome')
            ->get();

        $geradoEm = now()->format('d/m/Y H:i');
        $pdf = Pdf::loadView('relatorios.estoqueCritico', compact('produtos', 'geradoEm', 'limite'));
        return $pdf->stream('estoque-critico.pdf');
    }
}