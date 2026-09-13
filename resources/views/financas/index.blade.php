<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel Financeiro do Tatuador - Yato Tattoo') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if(session('sucesso'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">{{ session('sucesso') }}</div>
        @endif

        <!-- 📊 COMPONENTES DE RESUMO (CARDS FINANCEIROS) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-6 bg-gray-900 border border-gray-700 rounded-lg">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block">Receita Bruta (Entradas)</span>
                <span class="text-2xl font-black text-green-400 block mt-2">R$ {{ number_format($totalReceitas, 2, ',', '.') }}</span>
            </div>
            <div class="p-6 bg-gray-900 border border-gray-700 rounded-lg">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block">Custos Totais (Saídas)</span>
                <span class="text-2xl font-black text-red-400 block mt-2">R$ {{ number_format($totalCustos, 2, ',', '.') }}</span>
            </div>
            <div class="p-6 bg-gray-900 border border border-gray-700 rounded-lg {{ $lucroLiquido >= 0 ? 'border-green-600' : 'border-red-600' }}">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block">Lucro Líquido</span>
                <span class="text-2xl font-black {{ $lucroLiquido >= 0 ? 'text-green-400' : 'text-red-400' }} block mt-2">R$ {{ number_format($lucroLiquido, 2, ',', '.') }}</span>
            </div>
            <div class="p-6 bg-gray-900 border border-gray-700 rounded-lg">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block">Trabalhos Realizados</span>
                <span class="text-2xl font-black text-indigo-400 block mt-2">{{ $trabalhosRealizados }} tattoos</span>
            </div>
        </div>

        <!-- 🔎 FILTRO DE MÊS E ANO -->
        <div class="p-4 bg-gray-800 rounded-lg border border-gray-700">
            <form method="GET" action="{{ route('financas.index') }}" class="flex flex-wrap items-end gap-4">
                <div class="w-full sm:w-44">
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Mês de Referência</label>
                    <select name="mes" class="w-full rounded-md bg-gray-900 text-gray-300 border-gray-700">
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $mes == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="w-full sm:w-32">
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Ano</label>
                    <select name="ano" class="w-full rounded-md bg-gray-900 text-gray-300 border-gray-700">
                        <option value="2026" {{ $ano == 2026 ? 'selected' : '' }}>2026</option>
                        <option value="2027" {{ $ano == 2027 ? 'selected' : '' }}>2027</option>
                    </select>
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-xs uppercase font-bold tracking-widest hover:bg-indigo-700 transition">Filtrar Relatório</button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- 🗒️ FORMULÁRIO DE LANÇAMENTO -->
            <div class="p-6 bg-gray-800 rounded-lg border border-gray-700 h-fit">
                <h3 class="text-lg font-medium text-gray-100 mb-4">Lançar Nova Movimentação</h3>
                <form method="POST" action="{{ route('financas.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-300">Descrição do Lançamento</label>
                        <input type="text" name="descricao" placeholder="Ex: Tattoo Tribal Guilherme ou Compra de Agulhas" class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Tipo de Fluxo</label>
                        <select name="tipo" class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-500" required>
                            <option value="receita">Receita (+) Entrada de Tattoo</option>
                            <option value="custo">Custo (-) Saída / Insumos</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Valor (R$)</label>
                        <input type="number" name="valor" step="0.01" placeholder="0.00" class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Data do Pagamento</label>
                        <input type="date" name="data_movimentacao" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-500" required>
                    </div>
                    <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-xs uppercase font-bold tracking-widest transition">Salvar no Livro Caixa</button>
                </form>
            </div>

            <!-- 🗓️ LISTA DE LANÇAMENTOS DO MÊS -->
            <div class="lg:col-span-2 p-6 bg-gray-800 rounded-lg border border-gray-700">
                <h3 class="text-lg font-medium text-gray-100 mb-4">Histórico de Fluxo de Caixa</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-300">
                        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                            <tr>
                                <th class="px-4 py-3">Data</th>
                                <th class="px-4 py-3">Descrição</th>
                                <th class="px-4 py-3 text-right">Valor</th>
                                <th class="px-4 py-3 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($movimentacoes as $mov)
                                <tr class="border-b bg-gray-900 border-gray-700">
                                    <td class="px-4 py-3 text-gray-400">{{ date('d/m/Y', strtotime($mov->data_movimentacao)) }}</td>
                                    <td class="px-4 py-3 font-semibold text-white">
                                        <span class="inline-block w-2 h-2 rounded-full mr-2 {{ $mov->tipo == 'receita' ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                        {{ $mov->descricao }}
                                    </td>
                                    <td class="px-4 py-3 text-right font-black {{ $mov->tipo == 'receita' ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $mov->tipo == 'receita' ? '+' : '-' }} R$ {{ number_format($mov->valor, 2, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <form action="{{ route('financas.destroy', $mov->id) }}" method="POST" onsubmit="return confirm('Excluir este lançamento financeiro?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-600 text-xs underline">Estornar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-8 text-center text-gray-500">Nenhum fluxo de caixa registrado para este mês.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
