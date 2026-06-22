@include('includes.header', ['page_title' => 'Agendamentos', 'active_tab' => 'clientes'])

<div class="mb-10 flex items-center justify-between">
    <h1 class="text-3xl font-extrabold text-white">Agendamentos de Clientes</h1>
    <a href="{{ url('/clientes/create.php') }}" class="px-4 py-2 bg-gold-500 hover:bg-gold-600 text-neutral-950 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Novo Agendamento
    </a>
</div>

@if(request('status') == 'created')
    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">Agendamento criado com sucesso!</div>
@elseif(request('status') == 'updated')
    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">Agendamento atualizado com sucesso!</div>
@elseif(request('status') == 'deleted')
    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">Agendamento removido com sucesso!</div>
@endif

<div class="glass-card rounded-2xl overflow-hidden">
    <table class="w-full text-left">
        <thead>
            <tr class="border-b border-neutral-800 text-neutral-400 text-xs uppercase tracking-wider">
                <th class="px-6 py-4">Cliente</th>
                <th class="px-6 py-4">Corte</th>
                <th class="px-6 py-4">Horário</th>
                <th class="px-6 py-4">Pagamento</th>
                <th class="px-6 py-4 text-right">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agendamentos as $agendamento)
                <tr class="border-b border-neutral-800/50 hover:bg-neutral-900/30">
                    <td class="px-6 py-4 text-white font-medium">{{ $agendamento->nome }}</td>
                    <td class="px-6 py-4 text-neutral-300">{{ $agendamento->corte->nome_corte ?? '—' }}</td>
                    <td class="px-6 py-4 text-neutral-300">{{ \Carbon\Carbon::parse($agendamento->horario_agendamento)->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-neutral-300">{{ $agendamento->forma_pagamento }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ url('/clientes/update.php?id=' . $agendamento->id) }}" class="text-gold-500 hover:text-gold-400 mr-3">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a href="{{ url('/clientes/delete.php?id=' . $agendamento->id) }}"
                           onclick="return confirm('Tem certeza que deseja excluir este agendamento?');"
                           class="text-red-500 hover:text-red-400">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-neutral-500">
                        Nenhum agendamento cadastrado ainda.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('includes.footer')