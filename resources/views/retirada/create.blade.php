@section('title', 'Realizar Retirada')
<x-app-layout>
    <p>{{ session('mensagem') }}</p>
    <form action="{{ route('retirada.store') }}" method="post">
        @csrf
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Realizar Retirada') }}
                    </h2>
                </div>

                @if ($errors->has('produtos'))
                    <div class="alert dark:text-gray-100 alert-danger">
                        {{ $errors->first('produtos') }}
                    </div>
                @endif
                
                <!-- Campo para selecionar o cliente -->
                <div class="mt-4">
                    <x-input-label for="id_cliente"> Cliente: </x-input-label>
                    <select name="id_cliente" id="id_cliente" class="form-control" required>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo para a data da retirada -->
                <div class="mt-4">
                    <x-input-label for="dataRetirada" :value="__('Data da Retirada')" />
                    <x-text-input id="dataRetirada" class="block mt-1 w-full" type="date" name="dataRetirada" :value="old('dataRetirada')" required />
                </div>

                <!-- Campo para observações -->
                <div class="mt-4">
                    <x-input-label for="observacao" :value="__('Observação')" />
                    <x-text-input id="observacao" class="block mt-1 w-full" type="text" name="observacao" :value="old('observacao')" />
                </div>

                <!-- Lista de produtos dinâmica -->
                <div id="produtos-container">
                    <!-- Primeiro produto -->
                    <div class="produto-item mt-4">
                        <x-input-label for="produtos"> Produto: </x-input-label>
                        <select name="produtos[0][id]" class="form-control produto-select" required>
                            @foreach($produtos as $produto)
                            <option value="{{ $produto->id }}" data-estoque="{{ $produto->estoque }}">
                                {{ $produto->nome }} (Estoque: {{ $produto->estoque }})
                            </option>
                            @endforeach
                        </select>

                        <x-input-label for="quantidade" :value="__('Quantidade')" />
                        <x-text-input name="produtos[0][quantidade]" class="block mt-1 w-full quantidade-input" type="number" required min="1" max="1000" />
                        <div class="mt-2">
                            <!-- Botão de remoção -->
                            <button type="button" class="remover-produto bg-red-500 text-white px-2 py-1 rounded mt-2">
                                Remover
                            </button>
                            <!-- Botão para adicionar mais produtos -->
                            <button type="button" id="adicionar-produto" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Adicionar Produto
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Botões de ação -->
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('retirada.index') }}">Listar Retiradas</a>

                    <x-primary-button class="ms-4">
                        {{ __('Cadastrar') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    const produtosContainer = document.getElementById('produtos-container');
    const adicionarProdutoBtn = document.getElementById('adicionar-produto');
    let produtoIndex = 1; // Começa em 1 porque o primeiro produto já existe

    // Função para adicionar um novo produto
    adicionarProdutoBtn.addEventListener('click', function() {
        // Clona o primeiro produto
        const novoProduto = produtosContainer.querySelector('.produto-item').cloneNode(true);

        // Atualiza os nomes dos campos para o novo índice
        novoProduto.querySelector('.produto-select').name = `produtos[${produtoIndex}][id]`;
        novoProduto.querySelector('.quantidade-input').name = `produtos[${produtoIndex}][quantidade]`;

        // Limpa os valores selecionados
        novoProduto.querySelector('.produto-select').selectedIndex = 0;
        novoProduto.querySelector('.quantidade-input').value = '';

        // Adiciona o novo produto ao container
        produtosContainer.appendChild(novoProduto);

        // Adiciona um evento de clique ao botão de remoção
        const removerBtn = novoProduto.querySelector('.remover-produto');
        removerBtn.addEventListener('click', function() {
            novoProduto.remove(); // Remove o produto do DOM
        });

        // Adiciona um evento de change ao campo de seleção de produtos
        const produtoSelect = novoProduto.querySelector('.produto-select');
        const quantidadeInput = novoProduto.querySelector('.quantidade-input');

        produtoSelect.addEventListener('change', function() {
            const estoque = parseInt(this.options[this.selectedIndex].getAttribute('data-estoque'));
            quantidadeInput.setAttribute('max', estoque);
        });

        // Incrementa o índice para o próximo produto
        produtoIndex++;
    });

    // Adiciona evento de remoção ao primeiro produto (se existir)
    const primeiroRemoverBtn = produtosContainer.querySelector('.remover-produto');
    if (primeiroRemoverBtn) {
        primeiroRemoverBtn.addEventListener('click', function() {
            produtosContainer.querySelector('.produto-item').remove();
        });
    }

    // Adiciona evento de change ao primeiro produto (se existir)
    const primeiroProdutoSelect = produtosContainer.querySelector('.produto-select');
    const primeiraQuantidadeInput = produtosContainer.querySelector('.quantidade-input');

    if (primeiroProdutoSelect) {
        primeiroProdutoSelect.addEventListener('change', function() {
            const estoque = parseInt(this.options[this.selectedIndex].getAttribute('data-estoque'));
            primeiraQuantidadeInput.setAttribute('max', estoque);
        });
    }
});
</script>