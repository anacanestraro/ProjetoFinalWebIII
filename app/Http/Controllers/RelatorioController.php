<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cliente;
use App\Models\Produto;

class RelatorioController extends Controller{
    public function produtosSemEstoque(){
        $produtos = Produto::query()
        ->join('retirada_produtos', 'retirada_produtos.produto_id', '=', 'produtos.id')
        ->join('retiradas', 'retiradas.id', '=', 'retirada_produtos.retirada_id')
        ->where('produtos.estoque', '=', '0')
        ->selectRaw('produtos.*, retiradas.dataRetirada as dataRetirada')
        ->groupBy('retiradas.dataRetirada')
        ->groupBy('produtos.id')
        ->groupBy('produtos.imagem')
        ->groupBy('produtos.estoque')
        ->groupBy('produtos.descricao')
        ->groupBy('produtos.nome')
        ->groupBy('produtos.valorUnitario')
        ->groupBy('produtos.id_unidade')
        ->groupBy('produtos.id_categoria')
        ->groupBy('produtos.created_at')
        ->groupBy('produtos.updated_at')
        ->orderByDesc('retiradas.dataRetirada')->get();

        $pdf = Pdf::loadView('relatorios.produtosSemEstoque', compact('produtos'));
        return $pdf->stream('produtosSemEstoque');
    }

    public function produtosComEstoque(){
        $produtos = Produto::query()
        ->join('retirada_produtos', 'retirada_produtos.produto_id', '=', 'produtos.id')
        ->join('retiradas', 'retiradas.id', '=', 'retirada_produtos.retirada_id')
        ->where('produtos.estoque', '!=', '0')
        ->get();

        $pdf = Pdf::loadView('relatorios.produtosComEstoque', compact('produtos'));
        return $pdf->stream('produtosComEstoque');
    }

    public function retiradasPorCliente()
    {
    $clientes = Cliente::whereHas('retiradas')->with(['retiradas.produtos'])->get();

    foreach ($clientes as $cliente) {
        $cliente->retiradas = $cliente->retiradas->sortByDesc('dataRetirada');
    }

    $pdf = Pdf::loadView('relatorios.retiradasPorCliente', compact('clientes'));

    return $pdf->stream('retiradasPorCliente.pdf');
    }

}
