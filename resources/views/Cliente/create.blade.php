@section('title', 'Cadastrar Cliente')
<x-app-layout>

<form action="/cadastrarCliente" method="post">
    @csrf
    <p>{{session('mensagem')}}</p>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
    
            <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Cadastrar Cliente') }}
            </h2>
            </div>


            <div class="mt-4">
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autolcomplete="nome"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        
            <div class="mt-4">
                <x-input-label for="cpf" :value="__('Cpf')"/>
                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required autocomplete="cpf"/>
            </div>
            
            <div class="mt-4">
                <x-input-label for="telefone" :value="__('Telefone')"/>
                <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="old('telefone')" required autocomplete="telefone"/>
            </div>
        
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        
            <div class="flex items-center justify-end mt-4">
        
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('listarCliente') }}" >Listar Clientes</a>
        
                <x-primary-button class="ms-4">
                    {{ __('Cadastrar') }}
                </x-primary-button>
            </div>
        </div>
    </div>
    </form>
</x-app-layout>