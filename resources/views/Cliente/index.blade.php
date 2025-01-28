@section('title', 'Listar Clientes')
<x-app-layout>
    <div class="flex items-center justify-center h-screen mt-4">
        <div class="w-11/12 sm:w-11/12 md:w-12 lg:w-6/12 p-6 rounded-lg border-gray-100 border">
            <div class="w-full flex justify-between items-center p-3 gap-6">
                <h2 class="text-xl font-semibold dark:text-gray-100">Clientes</h2>
                <button class="flex items-center bg-gradient-to-r from-violet-300 to-indigo-300 border border-fuchsia-00 hover:border-violet-100 text-white font-semibold py-2 px-4 rounded-md transition-colors duration-300">
                    <svg class="w-4 h-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <a href="{{ route('cliente.create') }}" class="text-white">Novo Cliente</a>
                </button>
            </div>
            <div class="w-full flex justify-center py-4 mb-4 relative w-full">
                <x-text-input class="w-full" oninput="filtrarNomes(this.value)" type="text" placeholder="Buscar..." />
            </div>
            <!-- Cards clientes cadastrados -->
            <p class="mb-4 text-x2 font-semibold dark:text-gray-100">{{session('mensagem')}}</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4">
                @foreach($clientes as $cliente)
                <div class="cliente w-full max-w-sm border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class=" flex flex-col items-center pb-10">
                        <h5 class="nome mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$cliente->nome}}</h5>
                        <span class="text-sm text-gray-500 dark:text-gray400 px-2">{{$cliente->email}}</span>
                        <div class="flex mt-4 md:mt-6">
                            <a href="{{ route('cliente.edit', $cliente->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white "> Editar</a>
                            <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('TEM CERTEZA?');">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white" >Deletar</button>
                            </form>
                        </div>
                        <a href="{{ route('cliente.show', $cliente->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white "> Visualizar detalhes</a>
                    </div>

                </div>
                @endforeach
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