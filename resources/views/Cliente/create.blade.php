<script src="/js/cep.js"></script>
@section('title', 'Cadastrar Cliente')
<x-app-layout>

<p>{{session('mensagem')}}</p>
<form action="{{ route('cliente.store') }}" method="post">
    @csrf
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
    
            <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Cadastrar Cliente') }}
            </h2>
            </div>


            <div class="mt-4">
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="nome"/>
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>
        
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                <x-input-label for="cep" :value="__('Cep')"/>
                <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" :value="old('cep')" required autocomplete="cep" onblur="pesquisacep(this.value);"/>
            </div>

            <div class="mt-4">
                <x-input-label for="rua" :value="__('Rua')"/>
                <x-text-input id="rua" class="block mt-1 w-full" type="text" name="rua" :value="old('rua')" required autocomplete="rua"/>
            </div>

            <div class="mt-4">
                <x-input-label for="numero" :value="__('Número')"/>
                <x-text-input id="numero" class="block mt-1 w-full" type="text" name="numero" :value="old('numero')" required autocomplete="numero"/>
            </div>
        
            <div class="mt-4">
                <x-input-label for="bairro" :value="__('Bairro')"/>
                <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="bairro" :value="old('bairro')" required autocomplete="bairro"/>
            </div>

            <div class="mt-4">
                <x-input-label for="cidade" :value="__('Cidade')"/>
                <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" :value="old('cidade')" required autocomplete="cidade"/>
            </div>
            
            <div class="mt-4">
                <x-input-label for="uf" :value="__('UF')"/>
                <x-text-input id="uf" class="block mt-1 w-full" type="text" name="uf" :value="old('uf')" required autocomplete="uf"/>
            </div>

            <div class="flex items-center justify-end mt-4">
        
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('cliente.index') }}" >Listar Clientes</a>
        
                <x-primary-button class="ms-4">
                    {{ __('Cadastrar') }}
                </x-primary-button>
            </div>
        </div>
    </div>
    </form>
</x-app-layout>