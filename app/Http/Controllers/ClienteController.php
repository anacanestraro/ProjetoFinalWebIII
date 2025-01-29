<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index(){
        $clientes = Cliente::all();

        if ($clientes->isEmpty()) {
            session()->flash('mensagem', 'Nenhum cliente cadastrado.');
        }

        return view('cliente.index', compact('clientes'));
    }

    public function create(){
        return view ('cliente.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:clientes',
            'telefone' => 'required',
            'cep' => 'required',
            'email' => 'required|email',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|max:2',
        ]);

        $endereco = Endereco::firstOrCreate([
            'cep' => $validated['cep'],
            'rua' => $validated['rua'],
            'numero' => $validated['numero'],
            'bairro' => $validated['bairro'],
            'cidade' => $validated['cidade'],
            'uf' => $validated['uf'],
        ]);

        $status = Cliente::create([
            'nome' => $validated['nome'],
            'cpf' => $validated['cpf'],
            'telefone' => $validated['telefone'],
            'email' => $validated['email'],
            'endereco_id' => $endereco->id,
        ]);

        if($status){
            return redirect()->route('cliente.index')->with('mensagem', 'Cliente cadastrado com sucesso!');
        }else{
            return back()->with('mensagem', 'Erro ao cadastrar o cliente. Tente novamente.');
        }
    }

    public function show(Cliente $cliente){
        return view ('cliente.show', compact('cliente'));
    }

    public function edit(Cliente $cliente){
        return view('cliente.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente){
        $request->validate([
            'nome' => 'required|max:255',
            'cpf' => 'required|max:15|unique:clientes',
            'email' => 'required|max:255|unique:clientes',
            'telefone' => 'required|max:50',
            'cep' => 'required|min:9',
            'uf' => 'required|max:2',
            'cidade' => 'required|max:255',
            'bairro' => 'required|max:255',
            'rua' => 'required|max:255',
            'numero' => 'required|max:20',
        ]);

        $status = $cliente->update([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'email' => $request->email,
        ]);

        $endereco = Endereco::firstOrCreate([
            'cep' => $request->cep,
            'rua' => $request->rua,
            'uf' => $request->uf,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro,
            'numero' => $request->numero,

        ]);

        $cliente->endereco()->associate($endereco);

        if($status){
            return redirect()->route('cliente.index')->with('mensagem', 'Cliente atualizado com sucesso!');
        }else{
            return redirect()->route('cliente.index')->with('mensagem', 'Erro ao atualizar o cliente. Tente novamente.');
        }

    }

    public function destroy(Cliente $cliente){

        $status = $cliente->delete();

        if($status){
            return redirect()->route('cliente.index')->with('mensagem', 'Cliente deletado com sucesso!');
        }else{
            return redirect()->route('cliente.index')->with('mensagem', 'Erro ao deletar o cliente. Tente novamente.');
        }
    }
}
