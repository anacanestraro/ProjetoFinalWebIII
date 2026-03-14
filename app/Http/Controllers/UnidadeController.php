<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index(){
        $unidades = Unidade::paginate(15);
        return view('unidade.index', compact('unidades'));
    }

    public function create(){
        return view('unidade.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'sigla'    => 'required',
            'descricao'=> 'required',
        ]);

        Unidade::create($validated);
        return redirect()->route('unidade.index')->with('mensagem', 'Unidade cadastrada com sucesso!');
    }

    public function show(Unidade $unidade){
        return view('unidade.show', compact('unidade'));
    }

    public function edit(Unidade $unidade){
        return view('unidade.edit', compact('unidade'));
    }

    public function update(Unidade $unidade, Request $request){
        $request->validate([
            'sigla'    => 'required',
            'descricao'=> 'required',
        ]);

        $unidade->update([
            'sigla'    => $request->sigla,
            'descricao'=> $request->descricao,
        ]);

        return redirect()->route('unidade.index')->with('mensagem', 'Unidade atualizada com sucesso!');
    }

    public function destroy(Unidade $unidade){
        $unidade->delete();
        return redirect()->route('unidade.index')->with('mensagem', 'Unidade deletada com sucesso.');
    }
}