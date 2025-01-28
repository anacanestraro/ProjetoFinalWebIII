<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index(){
        $clientes = Cliente::all();
        return view('cliente.index', compact('clientes'));
    }

    public function create(){
        return view ('cliente.create');
    }

    public function store(Request $request){
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:clientes',
            'telefone' => 'required',
            'cep' => 'required',
            'email' => 'required|email',
        ]);

        $status = Cliente::create($request->all());

        if($status){
            return redirect()->route('cliente.index')->with('mensagem', 'Cliente cadastrado com sucesso!');
        }else{
            return redirect()->with('mensagem', 'Erro ao cadastrar o cliente. Tente novamente.');
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
            'nome' => 'required',
            'cpf' => 'required|unique:clientes,cpf,' . $cliente->id,
            'telefone' => 'required',
            'cep' => 'required',
            'email' => 'required|email',
        ]);

        $status = $cliente->update($request->all());

       
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
