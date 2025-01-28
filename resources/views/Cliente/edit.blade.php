@section('title', 'Atualizar Cliente')

<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">    
            <form action="{{ route('cliente.update', $cliente) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Atualizar cliente 
                    </h2>

                    <x-input-label class="mt-4"> Nome: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="nome" value="{{$cliente->nome}}"/>

                    <x-input-label class="mt-4"> Cpf: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="cpf" value="{{$cliente->cpf}}"/>

                    <x-input-label class="mt-4"> Cep: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="cep" value="{{$cliente->cep}}"/>

                    <x-input-label class="mt-4"> Telefone: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="telefone" value="{{$cliente->telefone}}"/>

                    <x-input-label class="mt-4"> E-mail: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="email" value="{{$cliente->email}}"/>

                    <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4" type="submit">Atualizar</x-primary-button>
                    </div>
            </form>
        </div>
    </div>
</x-app-layout>