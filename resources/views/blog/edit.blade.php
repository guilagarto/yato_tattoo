<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Artigo - Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-6">
                
                <header>
                    <h2 class="text-lg font-medium text-gray-100">Modificar Postagem Informativa</h2>
                    <p class="mt-1 text-sm text-gray-400">Altere o texto do artigo ou substitua a foto de capa atual do blog.</p>
                </header>

                <form method="POST" action="{{ route('blog.update', $post->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-sm text-gray-300" for="titulo">Título do Artigo</label>
                        <input id="titulo" name="titulo" type="text" value="{{ $post->titulo }}" class="mt-1 block w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-300 mb-2">Capa Atual</label>
                        @if($post->capa)
                            <img src="{{ asset('storage/' . $post->capa) }}" class="w-64 h-32 object-cover rounded-md border border-gray-700 mb-2">
                        @else
                            <p class="text-xs text-gray-500 italic mb-2">Nenhuma foto cadastrada para este post.</p>
                        @endif
                        <label class="block font-medium text-sm text-gray-400 mt-4" for="capa">Substituir Capa (Deixe em branco para manter a atual)</label>
                        <input id="capa" name="capa" type="file" class="mt-1 block w-full text-sm text-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-300" for="conteudo">Conteúdo do Artigo</label>
                        <textarea id="conteudo" name="conteudo" rows="10" class="mt-1 block w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>{{ $post->conteudo }}</textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-white transition">
                            Salvar Alterações
                        </button>
                        <a href="{{ route('blog.index') }}" class="text-sm text-gray-400 hover:text-white transition">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
