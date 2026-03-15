<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimentacaoController extends Controller
{
    public function index()
    {
        $movimentacoes = Movimentacao::with(['produto', 'user'])
            ->latest()
            ->paginate(20);

        return view('movimentacao.index', compact('movimentacoes'));
    }

    public function porProduto(Produto $produto)
    {
        $movimentacoes = $produto->movimentacoes()
            ->with('user')
            ->paginate(15);

        return view('movimentacao.por_produto', compact('produto', 'movimentacoes'));
    }

    public function entrada(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'motivo'     => 'nullable|string|max:255',
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        $estoque_antes  = $produto->estoque;
        $estoque_depois = $produto->estoque + $request->quantidade;

        $produto->increment('estoque', $request->quantidade);

        Movimentacao::create([
            'produto_id'    => $produto->id,
            'user_id'       => Auth::id(),
            'tipo'          => 'entrada',
            'quantidade'    => $request->quantidade,
            'estoque_antes' => $estoque_antes,
            'estoque_depois'=> $estoque_depois,
            'motivo'        => $request->motivo ?? 'Entrada manual',
        ]);

        return redirect()->back()->with('mensagem', "Entrada de {$request->quantidade} unidade(s) registrada para {$produto->nome}.");
    }
}