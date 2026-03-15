<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <style>
        .nav-brand-name { font-size: 0.9rem; font-weight: 700; color: #111827; letter-spacing: 0.04em; }
        .dark .nav-brand-name { color: #ffffff; }
        .nav-divider { width: 1px; height: 1.5rem; background: #e5e7eb; flex-shrink: 0; }
        .dark .nav-divider { background: #374151; }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Logo + links --}}
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:0.625rem; text-decoration:none; flex-shrink:0;">
                    <img src="{{ asset('favicon.ico') }}" alt="StockFlow" style="height:2rem; width:2rem; object-fit:contain;">
                    <span class="nav-brand-name" style="color:#ffffff;">StockFlow</span>
                </a>

                <div class="nav-divider hidden sm:block"></div>

                <div class="hidden sm:flex sm:items-center sm:gap-6">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                    <x-nav-link :href="route('produto.index')" :active="request()->routeIs('produto.*')">Produtos</x-nav-link>
                    <x-nav-link :href="route('cliente.index')" :active="request()->routeIs('cliente.*')">Clientes</x-nav-link>
                    <x-nav-link :href="route('retirada.index')" :active="request()->routeIs('retirada.*')">Retiradas</x-nav-link>
                    <x-nav-link :href="route('movimentacao.index')" :active="request()->routeIs('movimentacao.*')">Movimentações</x-nav-link>

                    {{-- Dropdown Cadastros --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false"
                            class="inline-flex items-center gap-1.5 px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out
                            {{ request()->routeIs('categoria.*') || request()->routeIs('unidade.*')
                                ? 'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100'
                                : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }}">
                            Cadastros
                            <svg class="w-3.5 h-3.5 transition-transform duration-150" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full mt-2 left-0 w-40 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-lg z-50 overflow-hidden py-1"
                            style="display:none;">
                            <a href="{{ route('categoria.index') }}"
                               class="flex items-center gap-2 px-4 py-2 text-sm {{ request()->routeIs('categoria.*') ? 'text-indigo-600 dark:text-indigo-400 font-medium bg-indigo-50 dark:bg-indigo-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                Categorias
                            </a>
                            <a href="{{ route('unidade.index') }}"
                               class="flex items-center gap-2 px-4 py-2 text-sm {{ request()->routeIs('unidade.*') ? 'text-indigo-600 dark:text-indigo-400 font-medium bg-indigo-50 dark:bg-indigo-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                Unidades
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Dropdown do usuário --}}
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ms-1 fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Perfil</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Sair
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Menu mobile --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('produto.index')" :active="request()->routeIs('produto.*')">Produtos</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cliente.index')" :active="request()->routeIs('cliente.*')">Clientes</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('retirada.index')" :active="request()->routeIs('retirada.*')">Retiradas</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('movimentacao.index')" :active="request()->routeIs('movimentacao.*')">Movimentações</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categoria.index')" :active="request()->routeIs('categoria.*')">Categorias</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('unidade.index')" :active="request()->routeIs('unidade.*')">Unidades</x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Perfil</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Sair
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>