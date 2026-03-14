<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Retirada;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function home(){
        $totalProdutos      = Produto::count();
        $totalClientes      = Cliente::count();
        $totalRetiradas     = Retirada::count();
        $totalCategorias    = Categoria::count();
        $semEstoque         = Produto::where('estoque', 0)->orWhereNull('estoque')->count();
        $ultimasRetiradas   = Retirada::with(['cliente', 'produtos'])->latest()->take(5)->get();
        $produtosCriticos   = Produto::where('estoque', '<=', 5)->orderBy('estoque')->take(5)->get();

        return view('home', compact(
            'totalProdutos',
            'totalClientes',
            'totalRetiradas',
            'totalCategorias',
            'semEstoque',
            'ultimasRetiradas',
            'produtosCriticos'
        ));
    }
}