<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Agenda e Disponibilidade - Yato Tattoo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('sucesso'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">{{ session('sucesso') }}</div>
            @endif

            <!-- Formulário: ADM Liberando Horários Livres -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Abrir Novos Horários na Agenda</h3>
                <p class="text-sm text-gray-400 mb-4">Selecione os dias e horas em que você estará disponível no estúdio para os clientes reservarem pelo site.</p>
                
                <form method="POST" action="{{ route('agenda.store') }}" class="space-y-4 max-w-xl">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300">Data Disponível</label>
                            <input type="date" name="data" class="mt-1 block w-full rounded-md dark:bg-gray-900 dark:text-gray-300 border-gray-700 focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300">Horário Disponível</label>
                            <input type="time" name="hora" class="mt-1 block w-full rounded-md dark:bg-gray-900 dark:text-gray-300 border-gray-700 focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-xs uppercase font-bold tracking-widest hover:bg-indigo-700 transition">Liberar Vaga no Site</button>
                </form>
            </div>

            <!-- Tabela de Controle de Atendimentos -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Fluxo de Horários e Reservas</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-300">
                        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Data</th>
                                <th class="px-6 py-3">Hora</th>
                                <th class="px-6 py-3">Cliente / Detalhes</th>
                                <th class="px-6 py-3">WhatsApp</th>
                                <th class="px-6 py-3">Status da Vaga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vagas as $vaga)
                                <tr class="border-b bg-gray-800 border-gray-700">
                                    <td class="px-6 py-4 font-medium text-white">{{ date('d/m/Y', strtotime($vaga->data)) }}</td>
                                    <td class="px-6 py-4 text-indigo-400 font-semibold">{{ date('H:i', strtotime($vaga->hora)) }}</td>
                                    <td class="px-6 py-4">
                                        @if($vaga->cliente_nome)
                                            <span class="text-white font-bold block">{{ $vaga->cliente_nome }}</span>
                                            <span class="text-xs text-gray-400">{{ $vaga->observacoes ?? 'Sem observações' }}</span>
                                        @else
                                            <span class="text-gray-500 italic">Aguardando cliente...</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $vaga->cliente_whatsapp ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        @if($vaga->status == 'disponivel')
                                            <span class="px-2 py-1 text-xs rounded bg-green-900 text-green-300 font-bold uppercase">Livre no Site</span>
                                        @elseif($vaga->status == 'reservado')
                                            <div class="flex flex-col gap-2">
                                                <span class="px-2 py-1 text-xs rounded bg-yellow-900 text-yellow-300 font-bold uppercase text-center">Pré-Reserva</span>
                                                <!-- Ações de Aprovação rápidas via formulário -->
                                                <div class="flex gap-1">
                                                    <form action="{{ route('agenda.status', $vaga->id) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="confirmado">
                                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] py-0.5 px-2 rounded">Confirmar</button>
                                                    </form>
                                                    <form action="{{ route('agenda.status', $vaga->id) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="disponivel">
                                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-[10px] py-0.5 px-2 rounded">Recusar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex flex-col gap-1">
                                                <span class="px-2 py-1 text-xs rounded bg-indigo-900 text-indigo-200 font-bold uppercase text-center">Confirmado ✅</span>
                                                <form action="{{ route('agenda.status', $vaga->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="disponivel">
                                                    <button type="submit" class="text-gray-500 hover:text-red-400 text-[10px] underline text-center block w-full mt-1">Liberar Horário</button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-gray-800"><td colspan="5" class="px-6 py-4 text-center text-gray-500">Nenhum horário aberto ou configurado ainda.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
