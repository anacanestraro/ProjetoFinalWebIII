<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cliente;
use App\Models\Produto;

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
}