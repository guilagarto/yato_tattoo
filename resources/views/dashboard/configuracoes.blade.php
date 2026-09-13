<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Customização da Home & Abertura de Agenda') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('sucesso'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">{{ session('sucesso') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- SEÇÃO DE HORÁRIOS DA AGENDA -->
            <div class="p-6 bg-gray-800 rounded-lg shadow space-y-4">
                <h3 class="text-lg font-medium text-gray-100">1. Abrir Vagas na Agenda Semanal/Mental</h3>
                <p class="text-sm text-gray-400">Escolha os dias e horários em que você estará disponível para tatuar.</p>
                
                <form method="POST" action="{{ route('admin.agenda.abrir') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300">Data</label>
                            <input type="date" name="data" class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300">Horário</label>
                            <input type="time" name="hora" class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700" required>
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-xs uppercase font-bold tracking-widest">Liberar Horário no Site</button>
                </form>

                <h4 class="font-bold text-gray-200 pt-4 border-t border-gray-700">Horários Configurados</h4>
                <div class="max-h-60 overflow-y-auto space-y-2">
                    @forelse($vagas as $vaga)
                        <div class="p-2 rounded bg-gray-900 border border-gray-700 flex justify-between items-center text-sm">
                            <div>
                                <span class="text-white font-semibold">{{ date('d/m/Y', strtotime($vaga->data)) }}</span> às 
                                <span class="text-indigo-400 font-semibold">{{ date('H:i', strtotime($vaga->hora)) }}</span>
                            </div>
                            <span class="px-2 py-0.5 text-xs rounded {{ $vaga->status == 'disponivel' ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }}">
                                {{ $vaga->status == 'disponivel' ? 'Livre no Site' : 'Pré-Reservado por ' . $vaga->cliente_nome }}
                            </span>
                        </div>
                    @empty
                        <p class="text-xs text-gray-500">Nenhum horário aberto ainda.</p>
                    @endforelse
                </div>
            </div>

            <!-- SEÇÃO DO CARROSSEL DE IMAGENS -->
            <div class="p-6 bg-gray-800 rounded-lg shadow space-y-4">
                <h3 class="text-lg font-medium text-gray-100">2. Montar Carrossel de Imagens (Banners da Home)</h3>
                <form method="POST" action="{{ route('admin.carrossel.salvar') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-300">Imagem do Banner (Alta Resolução)</label>
                        <input type="file" name="imagem" class="mt-1 block w-full text-sm text-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Título por cima da Imagem (Opcional)</label>
                        <input type="text" name="titulo" class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-xs uppercase font-bold tracking-widest">Adicionar ao Carrossel</button>
                </form>

                <h4 class="font-bold text-gray-200 pt-4 border-t border-gray-700">Banners Ativos</h4>
                <div class="grid grid-cols-2 gap-2 max-h-60 overflow-y-auto">
                    @foreach($banners as $banner)
                        <div class="relative rounded border border-gray-700 overflow-hidden h-24 bg-gray-900">
                            <img src="{{ asset('storage/' . $banner->imagem) }}" class="w-full h-full object-cover opacity-60">
                            <form action="{{ route('admin.carrossel.deletar', $banner->id) }}" method="POST" class="absolute top-1 right-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white text-[10px] font-bold p-1 rounded hover:bg-red-700">Excluir</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

                        <!-- SEÇÃO DE GERENCIAMENTO DE PROMOÇÕES -->
            <div class="p-6 bg-gray-800 rounded-lg shadow space-y-4 md:col-span-2">
                <h3 class="text-lg font-medium text-gray-100">3. Lançar Cupons e Promoções Ativas na Home</h3>
                <p class="text-sm text-gray-400">Os descontos configurados aqui aparecerão em destaque na página inicial dos clientes.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Formulário -->
                    <form method="POST" action="{{ route('admin.promocao.salvar') }}" class="space-y-4 md:col-span-1">
                        @csrf
                        <div>
                            <label class="block text-sm text-gray-300">Título da Campanha</label>
                            <input type="text" name="titulo" placeholder="Ex: Black Friday Tattoo" class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300">Cupom de Desconto (Opcional)</label>
                            <input type="text" name="cupom" placeholder="Ex: YATO20" class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300">Descrição do Benefício</label>
                            <textarea name="descricao" rows="3" placeholder="Ex: 20% de desconto em qualquer Flash Tattoo às terças-feiras." class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700" required></textarea>
                        </div>
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-xs uppercase font-bold tracking-widest transition">Ativar Promoção no Site</button>
                    </form>

                    <!-- Tabela de Listagem -->
                    <div class="md:col-span-2 space-y-2">
                        <h4 class="font-bold text-gray-200 text-sm">Promoções Ativas no Momento</h4>
                        <div class="max-h-60 overflow-y-auto space-y-2">
                            @forelse($promocoes as $promo)
                                <div class="p-3 rounded bg-gray-900 border border-gray-700 flex justify-between items-center gap-4">
                                    <div class="min-w-0 flex-1">
                                        <h5 class="text-white font-bold truncate">{{ $promo->titulo }}</h5>
                                        <p class="text-xs text-gray-400 line-clamp-1">{{ $promo->descricao }}</p>
                                        @if($promo->cupom)
                                            <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-mono bg-gray-800 text-yellow-400 border border-gray-700 rounded">CUPOM: {{ $promo->cupom }}</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('admin.promocao.deletar', $promo->id) }}" method="POST" onsubmit="return confirm('Deseja desativar e excluir esta promoção?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded transition">Desativar</button>
                                    </form>
                                </div>
                            @empty
                                <p class="text-xs text-gray-500 italic py-4">Nenhuma promoção ativa lançada na Home.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
