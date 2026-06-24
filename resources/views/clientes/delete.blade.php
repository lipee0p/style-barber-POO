@include('includes.header', ['page_title' => 'Excluir Agendamento', 'active_tab' => 'clientes'])

<div class="max-w-2xl">
    <h1 class="text-3xl font-extrabold text-white mb-8">Excluir Agendamento</h1>

    <div class="glass-card rounded-2xl p-8 flex flex-col gap-5">
        <p class="text-neutral-300">
            Tem certeza que deseja excluir o agendamento de
            <span class="text-white font-bold">{{ $agendamento->nome }}</span>
            marcado para
            <span class="text-white font-bold">{{ \Carbon\Carbon::parse($agendamento->horario_agendamento)->format('d/m/Y H:i') }}</span>?
        </p>
        <p class="text-sm text-red-400">Essa ação não pode ser desfeita.</p>

        <div class="flex gap-3 mt-2">
            <a href="{{ url('/clientes/delete.php?id=' . $agendamento->id . '&confirm=1') }}"
               class="bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl px-6 py-3 transition-all text-center">
                Confirmar Exclusão
            </a>

            <a href="{{ url('/clientes/read.php') }}"
               class="bg-neutral-800 hover:bg-neutral-700 text-white font-bold rounded-xl px-6 py-3 transition-all text-center">
                Cancelar
            </a>
        </div>
    </div>
</div>

@include('includes.footer')