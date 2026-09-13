<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Blog - Yato Tattoo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('sucesso'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">{{ session('sucesso') }}</div>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Nova Postagem Informativa</h3>
                <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data" class="space-y-4 w-full">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-300">Título do Artigo</label>
                        <input type="text" name="titulo" class="mt-1 block w-full rounded-md dark:bg-gray-900 dark:text-gray-300 border-gray-700" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Imagem de Capa</label>
                        <input type="file" name="capa" class="mt-1 block text-sm text-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Conteúdo do Artigo</label>
                        <textarea name="conteudo" rows="6" class="mt-1 block w-full rounded-md dark:bg-gray-900 dark:text-gray-300 border-gray-700" required></textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-xs uppercase font-bold tracking-widest hover:bg-indigo-700">Publicar Post</button>
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Artigos Publicados</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($posts as $post)
                        <div class="p-4 border border-gray-700 rounded-md bg-gray-900 flex gap-4">
                            @if($post->capa)
                                <img src="{{ asset('storage/' . $post->capa) }}" class="w-24 h-24 object-cover rounded-md">
                            @endif
                            <div>
                                <h4 class="font-bold text-white text-lg">{{ $post->titulo }}</h4>
                                <p class="text-xs text-gray-500 mb-2">URL amigável: /blog/{{ $post->slug }}</p>
                                <p class="text-sm text-gray-400 line-clamp-2">{{ Str::limit($post->conteudo, 100) }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Nenhum artigo publicado no blog.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
