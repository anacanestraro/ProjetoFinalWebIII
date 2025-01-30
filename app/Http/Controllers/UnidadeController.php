<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index(){
        $unidades = Unidade::all();

        if($unidades->isEmpty()){
            session()->flash('mensagem', 'Nenhuma unidade cadastrada.');
        }

        return view('unidade.index', compact('unidades'));
    }

    public function create(){
        return view('unidade.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'sigla' => 'required',
            'descricao' => 'required'
        ]);

        $status = Unidade::create([
            'sigla' => $validated['sigla'],
            'descricao' => $validated['descricao'] 
        ]);

        if($status){
            return redirect()->route('unidade.index')->with('mensagem', 'Unidade cadastrada com sucesso!');

        }else{
            return back()->with('mensagem', 'Erro ao cadastrar unidade. Tente novamente!');

        }
    }

    public function show(Unidade $unidade){
        return view('unidade.show', compact('unidade'));
    }

    public function edit(Unidade $unidade){
        return view('unidade.edit', compact('unidade'));
    }

    public function update(Unidade $unidade, Request $request){
        $request->validate([
            'sigla' => 'required',
            'descricao' => 'required'
        ]);

        $status = $unidade->update([
            'sigla' => $request->sigla,
            'descricao' => $request->descricao
        ]);

        if($status){
            return redirect()->route('unidade.index')->with('mensagem', 'Unidade atualizada com sucesso!');

        }else{
            return back()->with('mensagem', 'Erro ao atualizar unidade. Tente novamente.');
        }
    }

    public function destroy(Unidade $unidade){
        $status = $unidade->delete();

        if($status){
            return redirect()->route('unidade.index')->with('mensagem', 'Unidade deletada com sucesso.');

        }else{
            return back()->with('mensagem', 'Erro ao deletar unidade. Tente novamente.');
        }
    }
}
