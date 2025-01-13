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

        Cliente::create($request->all());

        return redirect()->route('clilente.index')->with('success', 'Cliente cadastrado com sucesso.');
    }

    public function show(Cliente $cliente){
        return view ('cliente.show', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente){
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:clientes,cpf,' . $cliente->id,
            'telefone' => 'required',
            'cep' => 'required',
            'email' => 'required|email',
        ]);

        $cliente->update($request->all());

        return redirect()->route('cliente.index')->with('success', 'Cliente atualizado com sucesso!');

    }

    public function destroy(Cliente $cliente){

        $cliente->delete();

        return redirect()->route('cliente.edit')->with('success', 'Cliente deletado com sucesso!');
    }
}
