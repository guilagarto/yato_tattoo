<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Agenda - Yato Tattoo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('sucesso'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">{{ session('sucesso') }}</div>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Novo Agendamento</h3>
                <form method="POST" action="{{ route('agenda.store') }}" class="space-y-4 max-w-xl">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-300">Nome do Cliente</label>
                        <input type="text" name="cliente_nome" class="mt-1 block w-full rounded-md dark:bg-gray-900 dark:text-gray-300 border-gray-700" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">WhatsApp</label>
                        <input type="text" name="cliente_whatsapp" placeholder="(00) 00000-0000" class="mt-1 block w-full rounded-md dark:bg-gray-900 dark:text-gray-300 border-gray-700" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300">Data</label>
                            <input type="date" name="data" class="mt-1 block w-full rounded-md dark:bg-gray-900 dark:text-gray-300 border-gray-700" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300">Horário</label>
                            <input type="time" name="hora" class="mt-1 block w-full rounded-md dark:bg-gray-900 dark:text-gray-300 border-gray-700" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Observações</label>
                        <textarea name="observacoes" rows="2" class="mt-1 block w-full rounded-md dark:bg-gray-900 dark:text-gray-300 border-gray-700"></textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-xs uppercase font-bold tracking-widest hover:bg-indigo-700">Agendar Horário</button>
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Próximos Atendimentos</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-300">
                        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Cliente</th>
                                <th class="px-6 py-3">WhatsApp</th>
                                <th class="px-6 py-3">Data</th>
                                <th class="px-6 py-3">Hora</th>
                                <th class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agendamentos as $agenda)
                                <tr class="border-b bg-gray-800 border-gray-700">
                                    <td class="px-6 py-4 font-medium text-white">{{ $agenda->cliente_nome }}</td>
                                    <td class="px-6 py-4">{{ $agenda->cliente_whatsapp }}</td>
                                    <td class="px-6 py-4">{{ date('d/m/Y', strtotime($agenda->data)) }}</td>
                                    <td class="px-6 py-4">{{ date('H:i', strtotime($agenda->hora)) }}</td>
                                    <td class="px-6 py-4"><span class="px-2 py-1 text-xs rounded bg-yellow-900 text-yellow-300">{{ $agenda->status }}</span></td>
                                </tr>
                            @empty
                                <tr class="bg-gray-800"><td colspan="5" class="px-6 py-4 text-center text-gray-500">Nenhum horário marcado ainda.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
