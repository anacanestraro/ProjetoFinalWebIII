@section('title', 'Detalhes do Cliente')
<x-app-layout>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100"> Detalhes do cliente</h2>
            
            <x-input-label class="mt-4">Nome: {{$cliente->nome}}</x-input-label>
            <x-input-label class="mt-4">CPF: {{$cliente->cpf}}</x-input-label>
            <x-input-label class="mt-4">Telefone: {{$cliente->telefone}}</x-input-label>
            <x-input-label class="mt-4">E-mail: {{$cliente->email}}</x-input-label>
            <x-input-label class="mt-4">CEP: {{$cliente->endereco->cep}}</x-input-label>
            <x-input-label class="mt-4">Rua: {{$cliente->endereco->rua}}</x-input-label>
            <x-input-label class="mt-4">Número: {{$cliente->endereco->numero}}</x-input-label>
            <x-input-label class="mt-4">Bairro: {{$cliente->endereco->bairro}}</x-input-label>
            <x-input-label class="mt-4">Cidade: {{$cliente->endereco->cidade}}</x-input-label>
            <x-input-label class="mt-4">UF: {{$cliente->endereco->uf}}</x-input-label>

           
            
            <div class="flex items-center justify-center gap-6 mt-4">
                <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('TEM CERTEZA?');">
                    @csrf 
                    @method('DELETE')
                    <x-primary-button type="submit">Deletar</x-primary-button>
                </form>
                <x-primary-button>
                    <a href="{{ route('cliente.edit', $cliente->id) }}" >Editar</a>
                </x-primary-button>

            </div>
        </div>
    </div>
</x-app-layout>