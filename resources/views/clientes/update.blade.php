@include('includes.header', ['page_title' => 'Editar Agendamento', 'active_tab' => 'clientes'])

<div class="max-w-2xl">
    <h1 class="text-3xl font-extrabold text-white mb-8">Editar Agendamento</h1>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/clientes/update.php?id=' . $agendamento->id) }}" class="glass-card rounded-2xl p-8 flex flex-col gap-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Nome do Cliente</label>
            <input type="text" name="nome" value="{{ old('nome', $agendamento->nome) }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Horário do Agendamento</label>
            <input type="datetime-local" name="horario_agendamento" value="{{ old('horario_agendamento', \Carbon\Carbon::parse($agendamento->horario_agendamento)->format('Y-m-d\TH:i')) }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Corte</label>
            <select name="corte_id" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500">
                <option value="">Selecione um corte (opcional)</option>
                @foreach($cortes as $corte)
                    <option value="{{ $corte->id }}" {{ old('corte_id', $agendamento->corte_id) == $corte->id ? 'selected' : '' }}>
                        {{ $corte->nome_corte }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Forma de Pagamento</label>
            <select name="forma_pagamento" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
                <option value="">Selecione</option>
                @foreach(['Dinheiro', 'Pix', 'Cartão de Débito', 'Cartão de Crédito'] as $forma)
                    <option value="{{ $forma }}" {{ old('forma_pagamento', $agendamento->forma_pagamento) == $forma ? 'selected' : '' }}>{{ $forma }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="mt-2 bg-gold-500 hover:bg-gold-600 text-neutral-950 font-bold rounded-xl px-6 py-3 transition-all">
            Atualizar Agendamento
        </button>
    </form>
</div>

@include('includes.footer')