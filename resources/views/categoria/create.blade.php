@section('title', 'Cadastrar categoria')
<x-app-layout>

<p>{{session('mensagem')}}</p>
<form action="{{ route('categoria.store') }}" method="post">
    @csrf
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
    
            <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Cadastrar categoria') }}
            </h2>
            </div>


            <div class="mt-4">
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="nome"/>
            </div>
        
            <div class="mt-4">
                <x-input-label for="descricao" :value="__('Descrição')" />
                <x-text-input id="descricao" class="block mt-1 w-full" type="text" name="descricao" :value="old('descricao')" required autofocus autocomplete="descricao" />
            </div>

            <div class="flex items-center justify-end mt-4">
        
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('categoria.index') }}" >Listar categorias</a>
        
                <x-primary-button class="ms-4">
                    {{ __('Cadastrar') }}
                </x-primary-button>
            </div>
        </div>
    </div>
    </form>
</x-app-layout>