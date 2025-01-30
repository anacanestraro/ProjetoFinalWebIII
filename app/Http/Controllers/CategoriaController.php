<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::all();

        if($categorias->isEmpty()){
            session()->flash('mensagem', 'Nenhuma categoria cadastrada.');
        }
        return view('categoria.index', compact('categorias'));
    }

    public function create(){
        return view('categoria.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nome' => 'required',
            'descricao'=>'required'
        ]);

        $status = Categoria::create([
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao']
        ]);

        if($status){
            return redirect()->route('categoria.index')->with('mensagem', 'Categoria cadastrada com sucesso!');
        }else{
            return back()->with('mensagem', 'Erro ao cadastrar categoria. Tente novamente.');
        }
    }

    public function show(Categoria $categoria){
        return view('categoria.show', compact('categoria'));
    }

    public function edit(Categoria $categoria){
        return view ('categoria.edit', compact('categoria'));
    }
    
    public function update(Categoria $categoria, Request $request){
        $request->validate([
            'nome' => 'required',
            'descricao'=>'required'
        ]);

        $status = $categoria->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ]);

        if($status){
            return redirect()->route('categoria.index')->with('mensagem', 'Categoria atualizada com sucesso!');
        }else{
            return back()->with('mensagem', 'Erro ao atualizar categoria. Tente novamente.');
        }
    }

    public function destroy(Categoria $categoria){
        $status = $categoria->delete();

        if($status){
            return redirect()->route('categoria.index')->with('mensagem', 'Categoria deletada com sucesso!');
            
        }else{
            return back()->with('mensagem', 'Erro ao deletar categoria. Tente novamente.');
        }
    }
}
