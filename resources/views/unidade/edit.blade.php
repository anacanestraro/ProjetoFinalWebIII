@section('title', 'Atualizar Unidade')

<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">    
            <form action="{{ route('unidade.update', $unidade) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Atualizar unidade 
                    </h2>

                    <x-input-label class="mt-4"> Sigla: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="sigla" value="{{$unidade->sigla}}"/>

                    <x-input-label class="mt-4"> Descrição: </x-input-label>
                    <x-text-input class="block mt-1 w-full" type="text" name="descricao" value="{{$unidade->descricao}}"/>


                    <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4" type="submit">Atualizar</x-primary-button>
                    </div>
            </form>
        </div>
    </div>
</x-app-layout>