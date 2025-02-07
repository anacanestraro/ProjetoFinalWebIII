@section('title', 'Detalhes do Produto')
<x-app-layout>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100"> Detalhes do produto [{{$produto->nome}}]</h2>
            
            <img src="{{ asset('img/produtos/'.$produto->imagem) }}" alt="Imagem do produto" class="w-32 h-32 object-cover mx-auto rounded-lg mb-4 mshadow-md shadow-teal-50">
            <x-input-label class="mt-4">Nome: {{$produto->nome}}</x-input-label>
            <x-input-label class="mt-4">Estoque: {{$produto->estoque}}</x-input-label>
            <x-input-label class="mt-4">Descrição: {{$produto->descricao}}</x-input-label>
            <x-input-label class="mt-4">Valor Unitário: R$ {{ number_format($produto->valorUnitario, 2, ',', '.') }}</x-input-label>
            <x-input-label class="mt-4">Unidade: {{ $produto->unidade ? $produto->unidade->sigla : 'Sem unidade' }}</x-input-label>
            <x-input-label class="mt-4">Categoria: {{ $produto->categoria ? $produto->categoria->nome : 'Sem categoria' }}</x-input-label>
           
            
            <div class="flex items-center justify-center mt-4">
                <form action="{{ route('produto.destroy', $produto->id) }}" method="POST" onsubmit="return confirm('TEM CERTEZA?');">
                    @csrf 
                    @method('DELETE')
                    <x-primary-button type="submit">Deletar</x-primary-button>
                </form>
                <a href="{{ route('produto.edit', $produto->id) }}" >Editar</a>
            </div>
        </div>
    </div>
</x-app-layout>