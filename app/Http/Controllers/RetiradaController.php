<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Retirada;
use App\Models\Produto;
use App\Models\Cliente;

class RetiradaController extends Controller
{

    public function ticket($id){
            $retirada = Retirada::with(['cliente', 'produtos'])->findOrFail($id);

            $pdf = Pdf::loadView('retirada.ticket', compact('retirada'));

            $fileName = 'ticket_retirada_' . $retirada->id . '.pdf';

            return $pdf->stream($fileName);
    }

    public function index(){

        $retiradas = Retirada::with(['cliente', 'produtos'])->get();

        if($retiradas->isEmpty()){
            session()->flash('mensagem', 'Nenhuma retirada cadastrada.');
        }

        return view('retirada.index', compact('retiradas'));

    }

    public function create(){
        $clientes = Cliente::all();
        $produtos = Produto::all();
        
        if($clientes->isEmpty() || $produtos->isEmpty()){
            return redirect()->back()->with('error', 'Cadastre cliente e produtos antes de fazer uma retirada.');
        }
        return view('retirada.create', compact('clientes', 'produtos'));

    }   

    public function store(Request $request)
    {

        // Validação dos dados
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'dataRetirada' => 'required|date',
            'produtos' => 'required|array',
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1'
        ]);

        // Verifica se há estoque suficiente para todos os produtos
        foreach ($request->produtos as $produto) {
            $produtoModel = Produto::find($produto['id']);

            // Verifica se a quantidade solicitada é maior que o estoque disponível
            if ($produtoModel->estoque < $produto['quantidade']) {
                return redirect()->back()
                    ->withInput() // Mantém os dados preenchidos no formulário
                    ->withErrors(['produtos' => "Estoque insuficiente para o produto {$produtoModel->nome}. Estoque disponível: {$produtoModel->estoque}"]);
            }
        }

        // Cria a retirada
        $retirada = Retirada::create([
            'id_cliente' => $request->id_cliente,
            'dataRetirada' => $request->dataRetirada,
            'observacao' => $request->observacao,
        ]);

        // Adiciona os produtos à retirada e atualiza o estoque
        foreach ($request->produtos as $produto) {
            $produtoModel = Produto::find($produto['id']);

            // Adiciona o produto à retirada
            $retirada->produtos()->attach($produto['id'], [
                'quantidade' => $produto['quantidade'],
                'valorUnitario' => $produtoModel->valorUnitario,
            ]);

            // Atualiza o estoque do produto
            $produtoModel->decrement('estoque', $produto['quantidade']);
        }

        return redirect()->route('retirada.index', $retirada->id)->with('success', 'Retirada realizada com sucesso!');
    }

    public function show(Retirada $retirada){
        return view('retirada.show', compact('retirada'));
    }

    public function edit(Retirada $retirada){
        $clientes = Cliente::all();
        $produtos = Produto::all();

        return view('retirada.edit', compact('retirada', 'clientes', 'produtos'));
    }
}
