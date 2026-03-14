<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::paginate(15);
        return view('categoria.index', compact('categorias'));
    }

    public function create(){
        return view('categoria.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nome'     => 'required',
            'descricao'=> 'required',
        ]);

        Categoria::create($validated);
        return redirect()->route('categoria.index')->with('mensagem', 'Categoria cadastrada com sucesso!');
    }

    public function show(Categoria $categoria){
        return view('categoria.show', compact('categoria'));
    }

    public function edit(Categoria $categoria){
        return view('categoria.edit', compact('categoria'));
    }

    public function update(Categoria $categoria, Request $request){
        $request->validate([
            'nome'     => 'required',
            'descricao'=> 'required',
        ]);

        $categoria->update([
            'nome'     => $request->nome,
            'descricao'=> $request->descricao,
        ]);

        return redirect()->route('categoria.index')->with('mensagem', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria){
        $categoria->delete();
        return redirect()->route('categoria.index')->with('mensagem', 'Categoria deletada com sucesso!');
    }
}