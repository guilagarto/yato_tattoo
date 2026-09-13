<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Portfólio - Yato Tattoo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Mensagem de Sucesso -->
            @if(session('sucesso'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                    {{ session('sucesso') }}
                </div>
            @endif

            <!-- Formulário de Upload -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Adicionar Novo Trabalho</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Poste uma foto da sua última tatuagem finalizada para o site público.</p>
                </header>

                <form method="POST" action="{{ route('portfolio.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6 max-w-xl">
                    @csrf

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="titulo">Título do Trabalho</label>
                        <input id="titulo" name="titulo" type="text" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="estilo">Estilo da Tatuagem</label>
                        <input id="estilo" name="estilo" type="text" placeholder="Ex: Realismo, Old School, Blackwork" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="imagem">Foto da Tatuagem (JPEG, PNG, WEBP)</label>
                        <input id="imagem" name="imagem" type="file" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="descricao">Descrição / Observações</label>
                        <textarea id="descricao" name="descricao" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Salvar no Portfólio
                        </button>
                    </div>
                </form>
            </div>

            <!-- Lista de Trabalhos Já Cadastrados -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Trabalhos Cadastrados</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @forelse($trabalhos as $trabalho)
                        <div class="border dark:border-gray-700 p-2 rounded-lg bg-gray-50 dark:bg-gray-900">
    <img src="{{ asset('storage/' . $trabalho->imagem) }}" class="w-full h-48 object-cover rounded-md mb-2">
    <h4 class="font-bold text-gray-800 dark:text-gray-200">{{ $trabalho->titulo }}</h4>
    <span class="text-xs text-indigo-500 font-semibold block mb-3">{{ $trabalho->estilo ?? 'Estilo Livre' }}</span>
    
    <!-- BLOCO DE AÇÕES (EDITAR E EXCLUIR) -->
    <div class="flex justify-between items-center gap-2 mt-2 pt-2 border-t border-gray-700">
        <a href="{{ route('portfolio.edit', $trabalho->id) }}" class="text-xs bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded transition">
            Editar
        </a>
        
        <form action="{{ route('portfolio.destroy', $trabalho->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta foto?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-xs bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded transition">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>

                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Nenhum trabalho adicionado ao portfólio ainda.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
