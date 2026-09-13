<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Blog - Yato Tattoo') }}
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

            <!-- Formulário de Nova Postagem -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Nova Postagem Informativa</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Escreva um artigo com dicas ou cuidados sobre tatuagem para o site público.</p>
                </header>

                <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6 w-full">
                    @csrf

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="titulo">Título do Artigo</label>
                        <input id="titulo" name="titulo" type="text" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="capa">Imagem de Capa (JPEG, PNG, WEBP)</label>
                        <input id="capa" name="capa" type="file" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="conteudo">Conteúdo do Artigo</label>
                        <textarea id="conteudo" name="conteudo" rows="6" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Publicar Artigo
                        </button>
                    </div>
                </form>
            </div>

            <!-- Lista de Artigos Publicados -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Artigos Publicados</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($posts as $post)
                        <div class="p-4 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-900 flex gap-4">
    @if($post->capa)
        <img src="{{ asset('storage/' . $post->capa) }}" class="w-24 h-24 object-cover rounded-md flex-shrink-0">
    @endif
    <div class="flex-1 min-w-0 flex flex-col justify-between">
        <div>
            <h4 class="font-bold text-gray-800 dark:text-white text-lg truncate">{{ $post->titulo }}</h4>
            <p class="text-xs text-gray-500 mb-2">URL amigável: /blog/{{ $post->slug }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-2">{{ Str::limit($post->conteudo, 80) }}</p>
        </div>
        
        <!-- BOTÕES DE AÇÃO ADICIONADOS AQUI -->
        <div class="flex gap-2 mt-2 pt-2 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('blog.edit', $post->id) }}" class="text-xs bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded transition">
                Editar
            </a>
            <form action="{{ route('blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir esta postagem do blog?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-xs bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded transition">
                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Nenhum artigo publicado no blog ainda.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
