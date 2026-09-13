<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Trabalho - Portfólio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-6">
                
                <header>
                    <h2 class="text-lg font-medium text-gray-100">Modificar Detalhes da Arte</h2>
                    <p class="mt-1 text-sm text-gray-400">Altere as informações ou substitua a foto atual do portfólio.</p>
                </header>

                <form method="POST" action="{{ route('portfolio.update', $trabalho->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-sm text-gray-300" for="titulo">Título do Trabalho</label>
                        <input id="titulo" name="titulo" type="text" value="{{ $trabalho->titulo }}" class="mt-1 block w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-300" for="estilo">Estilo</label>
                        <input id="estilo" name="estilo" type="text" value="{{ $trabalho->estilo }}" class="mt-1 block w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-300 mb-2">Foto Atual</label>
                        <img src="{{ asset('storage/' . $trabalho->imagem) }}" class="w-40 h-40 object-cover rounded-md border border-gray-700 mb-2">
                        <label class="block font-medium text-sm text-gray-400 mt-4" for="imagem">Substituir Foto (Deixe em branco para manter a atual)</label>
                        <input id="imagem" name="imagem" type="file" class="mt-1 block w-full text-sm text-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-300" for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="3" class="mt-1 block w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">{{ $trabalho->descricao }}</textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-white transition">
                            Salvar Alterações
                        </button>
                        <a href="{{ route('portfolio.index') }}" class="text-sm text-gray-400 hover:text-white transition">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
