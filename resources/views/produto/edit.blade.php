@section('title', 'Atualizar Produto')

<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">    
            <form action="{{ route('produto.update', $produto) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Atualizar Produto [{{$produto->nome}}] 
                    </h2>

                    <x-input-label for="imagem">Imagem do Produto:</x-input-label>
                    <img id="imagem" src="{{ asset('img/produtos/'.$produto->imagem) }}" alt="Imagem do produto" class="w-32 h-32 object-cover mx-auto rounded-lg mb-4 mshadow-md shadow-teal-50">
                    <input type="file" id="imagem" name="imagem" class="form-control-file" onChange="ImagemPreview(event)">
                
                    <x-input-label class="mt-4"> Nome: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="nome" value="{{$produto->nome}}"/>

                    <x-input-label class="mt-4"> Estoque: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="estoque" value="{{$produto->estoque}}"/>

                    <x-input-label class="mt-4"> Descrição: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="descricao" value="{{$produto->descricao}}"/>

                    <x-input-label class="mt-4"> Valor Unitário: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="valorUnitario" value="{{$produto->valorUnitario}}"/>

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
                    
                    <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4" type="submit">Atualizar</x-primary-button>
                    </div>
            </form>
        </div>
    </div>
</x-app-layout>