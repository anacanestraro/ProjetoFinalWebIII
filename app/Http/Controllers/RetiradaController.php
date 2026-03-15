<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Retirada;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Movimentacao;

class RetiradaController extends Controller
{
    public function ticket($id){
        $retirada = Retirada::with(['cliente', 'produtos'])->findOrFail($id);
        $pdf      = Pdf::loadView('retirada.ticket', compact('retirada'));
        return $pdf->stream('ticket_retirada_'.$retirada->id.'.pdf');
    }

    public function index(){
        $retiradas = Retirada::with(['cliente', 'produtos'])->latest()->paginate(15);
        return view('retirada.index', compact('retiradas'));
    }

    public function create(){
        $clientes = Cliente::orderBy('nome')->get();
        $produtos = Produto::where('estoque', '>', 0)->orderBy('nome')->get();

        if($clientes->isEmpty() || $produtos->isEmpty()){
            return redirect()->back()->with('error', 'Cadastre clientes e produtos antes de fazer uma retirada.');
        }

        return view('retirada.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request){
        $request->validate([
            'id_cliente'            => 'required|exists:clientes,id',
            'dataRetirada'          => 'required|date',
            'produtos'              => 'required|array',
            'produtos.*.id'         => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);

        foreach ($request->produtos as $item) {
            $produto = Produto::find($item['id']);
            if ($produto->estoque < $item['quantidade']) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['produtos' => "Estoque insuficiente para {$produto->nome}. Disponível: {$produto->estoque}"]);
            }
        }

        $retirada = Retirada::create([
            'id_cliente'   => $request->id_cliente,
            'dataRetirada' => $request->dataRetirada,
            'observacao'   => $request->observacao,
        ]);

        foreach ($request->produtos as $item) {
            $produto        = Produto::find($item['id']);
            $estoque_antes  = $produto->estoque;
            $estoque_depois = $produto->estoque - $item['quantidade'];

            $retirada->produtos()->attach($item['id'], [
                'quantidade'    => $item['quantidade'],
                'valorUnitario' => $produto->valorUnitario,
            ]);

            $produto->decrement('estoque', $item['quantidade']);

            Movimentacao::create([
                'produto_id'    => $produto->id,
                'user_id'       => Auth::id(),
                'tipo'          => 'saida',
                'quantidade'    => $item['quantidade'],
                'estoque_antes' => $estoque_antes,
                'estoque_depois'=> $estoque_depois,
                'motivo'        => 'Retirada #'.$retirada->id,
            ]);
        }

        return redirect()->route('retirada.index')->with('success', 'Retirada realizada com sucesso!');
    }

    public function show(Retirada $retirada){
        return view('retirada.show', compact('retirada'));
    }

    public function edit(Retirada $retirada){
        $clientes = Cliente::orderBy('nome')->get();
        $produtos = Produto::orderBy('nome')->get();
        return view('retirada.edit', compact('retirada', 'clientes', 'produtos'));
    }
}