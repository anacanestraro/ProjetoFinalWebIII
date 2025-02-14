<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Unidade;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(){

        $produtos = Produto::with(['categoria', 'unidade'])->get();

        if($produtos->isEmpty()){
            session()->flash('mensagem', 'Nenhum produto cadastrado.');
        }

        return view('produto.index', compact('produtos'));
    }

    public function create(){
        $categorias = Categoria::all();
        $unidades = Unidade::all();
        return view('produto.create', compact('categorias', 'unidades'));
    }

    public function store(Request $request){

        $request->merge([
            'valorUnitario' => str_replace(',', '.', $request->valorUnitario),
        ]);

        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'required|image|image:2048',
            'estoque' => 'required|integer',
            'descricao' => 'required|string',
            'valorUnitario' => 'required|decimal:2',
            'id_unidade' => 'required|exists:unidades,id',
            'id_categoria' => 'required|exists:categorias,id',
        ]);

        
        $dados = $request->all();
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $requestImagem = $request->file('imagem');
            $extensao = $requestImagem->extension();
            $nomeImagem = md5($requestImagem->getClientOriginalName().strtotime("now")). '.'.$extensao;
            $request->imagem->move(public_path('img/produtos'), $nomeImagem);
            $dados['imagem'] = $nomeImagem;

        }else{
            $dados['imagem'] = "nulo.jpg";
        }

        Produto::create($dados);

        return redirect()->route('produto.index')->with('success', 'Produto cadastrado com sucesso!');

    }

    public function show(Produto $produto){
        return view('produto.show', compact('produto'));
    }

    public function edit(Produto $produto){

        $categorias = Categoria::all();
        $unidades = Unidade::all();

        return view('produto.edit', compact('produto', 'categorias', 'unidades'));
    }

    public function update(Request $request, Produto $produto){
        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|image|max:2048',
            'estoque' => 'required|integer',
            'descricao' => 'required|string',
            'valorUnitario' => 'required|decimal:2',
            'id_unidade' => 'required|exists:unidades,id',
            'id_categoria' => 'required|exists:categorias,id',
        ]);

        $dados = $request->all();
        
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            if($produto->imagem && file_exists(public_path('img/produtos/' . $produto->imagem))){
                unlink(public_path('img/produtos/' . $produto->imagem));

            }

            $requestImagem = $request->file('imagem');
            $extensao = $requestImagem->extension();
            $nomeImagem = md5($requestImagem->getClientOriginalName().strtotime("now")). '.'.$extensao;
            $request->imagem->move(public_path('img/produtos'), $nomeImagem);
            $dados['imagem'] = $nomeImagem;


        }else{
            $dados['imagem'] = $produto->imagem;
        }

        $produto->update($dados);
          

        return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto){

        if($produto->imagem && $produto->imagem != "nulo.jpg"){
            $caminhoImagem = public_path('img/produtos/' . $produto->imagem);

            if(file_exists($caminhoImagem)){
                unlink($caminhoImagem);
            }
        }

        $produto->delete();

        return redirect()->route('produto.index')->with('success', 'Produto deletado com sucesso!');
    }
}
