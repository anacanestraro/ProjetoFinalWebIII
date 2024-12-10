@section('title', 'Listar Clientes')
<x-app-layout>
    <div class="bg-gradient-to-r from-violet-100 to-indigo-100 flex items-center justify-center h-screen mt-4">
        <div class="w-11/12 sm:w-11/12 md:w/12 lg:w-6/12 backdrop-blur-sm bg-white/40 p-6 rounded-lg shadow-sm border-gray-100 border">
            <div class="w-full flex justify-between items-center p-3">
                <h2 class="text- x1 font-semibold dark:text-gray-100">Clientes</h2>
                <button class="flex items-center bg-gradient-to-r from-violet-300 to-indigo300 border border-fuchsia-00 hover:border-violet-100 text-white font-semibold py-2 px-4 rounded-md transition-colors duration-300">
                    <svg class="w-4 h-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <a href="{{ route('cadastrarCliente') }}" class="text-white">Novo Cliente</a>
                </button>
            </div>
            <div class="w-full flex justify-center p-1 mb-4 relative w-full">
                    <x-text-input oninput="filtrarNomes(this.value)" type="text" placeholder="Buscar..."/>
            </div>
            <div class="grid grid-cols1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4">
                <p>{{session('mensagem')}}</p>
                <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($clientes as $cliente)
                    <li class="cliente col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                        <div class="flex w-full items-center justify-between space-x-6 p-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="nome truncate text-sm font-medium text-gray-900">{{$cliente->nome}}</h3>
                                </div>
                                <p class="mt-1 truncate text-sm text-gray-500">{{$cliente->email}}</p>
                            </div>
                        </div>
                        <div>
                            <div class="-mt-px flex divide-x divide-gray-200">
                                <div class="flex w-0 flex-1">
                                    <form action="deletarCliente/{{$cliente->id}}" method="POST" onsubmit="return confirm('TEM CERTEZA?');" class="flex w-0 flex-1">
                                        @csrf 
                                        @method('DELETE')
                                        <x-primary-button class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                            Deletar
                                        </x-primary-button> 
                                    </form>
                                </div>
                                <div class="-ml-px flex w-0 flex-1">
                                    <x-primary-button class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                        <a href="editarCliente/{{$cliente->id}}" >Editar</a>
                                    </x-primary-button> 
                                </div>
                            </div>
                            <div class="flex flex-1 w-full">
                                <x-primary-button class="sm:w-full md:w-full lg:w-full">
                                    <a href="mostrarCliente/{{$cliente->id}}">Visualizar Detalhes</a>
                                </x-primary-button>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function filtrarNomes(valor) { // recebendo o valor que é colocado no input
        const linhas = document.querySelectorAll(".cliente"); // seleciona as linhas da tabela que possuem a classe cliente
        linhas.forEach(linha => {
            const nome = linha.querySelector(".nome").textContent.toLowerCase();
            linha.style.display = nome.includes(valor.toLowerCase()) ? "" : "none";
        });
    }
</script>