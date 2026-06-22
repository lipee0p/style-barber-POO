@include('includes.header', ['page_title' => 'Novo Agendamento', 'active_tab' => 'clientes'])

<div class="max-w-2xl">
    <h1 class="text-3xl font-extrabold text-white mb-8">Novo Agendamento</h1>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('clientes.store') }}" class="glass-card rounded-2xl p-8 flex flex-col gap-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Nome do Cliente</label>
            <input type="text" name="nome" value="{{ old('nome') }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Horário do Agendamento</label>
            <input type="datetime-local" name="horario_agendamento" value="{{ old('horario_agendamento') }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Corte</label>
            <select name="corte_id" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500">
                <option value="">Selecione um corte (opcional)</option>
                @foreach($cortes as $corte)
                    <option value="{{ $corte->id }}" {{ old('corte_id') == $corte->id ? 'selected' : '' }}>
                        {{ $corte->nome_corte }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Forma de Pagamento</label>
            <select name="forma_pagamento" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
                <option value="">Selecione</option>
                <option value="Dinheiro" {{ old('forma_pagamento') == 'Dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                <option value="Pix" {{ old('forma_pagamento') == 'Pix' ? 'selected' : '' }}>Pix</option>
                <option value="Cartão de Débito" {{ old('forma_pagamento') == 'Cartão de Débito' ? 'selected' : '' }}>Cartão de Débito</option>
                <option value="Cartão de Crédito" {{ old('forma_pagamento') == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
            </select>
        </div>

        <button type="submit" class="mt-2 bg-gold-500 hover:bg-gold-600 text-neutral-950 font-bold rounded-xl px-6 py-3 transition-all">
            Salvar Agendamento
        </button>
    </form>
</div>

@include('includes.footer')