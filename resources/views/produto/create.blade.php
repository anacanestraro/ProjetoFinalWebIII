@section('title', 'Cadastrar Produto')
<x-app-layout>

<p>{{session('mensagem')}}</p>
<form action="{{ route('produto.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
    
            <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Cadastrar Produto') }}
            </h2>
            </div>

            <div class="mt-4">
                <label for="imagem"> Imagem do Produto</label>
                <img id="imagemPreview" src="#" alt="Imagem do Produto" style="max-width: 350px; display: none; margin-top: 10px; margin:0 auto;">
                <input type="file" id="imagem" name="imagem" class="form-control-file" onchange="ImgemPreview(event)" required>
            </div>

            <div class="mt-4">
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="nome"/>
            </div>
        
            <div class="mt-4">
                <x-input-label for="estoque" :value="__('Estoque')" />
                <x-text-input id="estoque" class="block mt-1 w-full" type="text" name="estoque" :value="old('estoque')"/>
            </div>

            <div class="mt-4">
                <x-input-label for="descricao" :value="__('Descrição')"/>
                <x-text-input id="descricao" class="block mt-1 w-full" type="text" name="descricao" :value="old('descricao')" required autocomplete="descricao"/>
            </div>
            
            <div class="mt-4">
                <x-input-label for="valorUnitario" :value="__('Valor Unitário')"/>
                <x-text-input id="valorUnitario" class="block mt-1 w-full" type="text" name="valorUnitario" step="0.01" min="0.01" :value="old('valorUnitario')" required autocomplete="valorUnitario"/>
            </div>

            <div class="mt-4">
                <label for="id_unidade"> Unidade de Medida </label>
                <select name="id_unidade" id="id_unidade" class="form-control" required>
                    @foreach($unidades as $unidade)
                        <option value="{{$unidade->id}}">{{$unidade->sigla}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="id_categoria"> Categoria </label>
                <select name="id_categoria" id="id_categoria" class="form-control" required>
                    @foreach($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center justify-end mt-4">
        
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('produto.index') }}" >Listar Produtos</a>
        
                <x-primary-button class="ms-4">
                    {{ __('Cadastrar') }}
                </x-primary-button>
            </div>
        </div>
    </div>
    </form>
</x-app-layout>