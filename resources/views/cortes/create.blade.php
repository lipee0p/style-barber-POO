@include('includes.header', ['page_title' => 'Novo Corte', 'active_tab' => 'cortes'])

<div class="max-w-2xl">
    <h1 class="text-3xl font-extrabold text-white mb-8">Novo Estilo de Corte</h1>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cortes.store') }}" class="glass-card rounded-2xl p-8 flex flex-col gap-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Nome do Corte</label>
            <input type="text" name="nome_corte" value="{{ old('nome_corte') }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Valor (R$)</label>
            <input type="number" step="0.01" name="valor" value="{{ old('valor') }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Acréscimo Freestyle (R$)</label>
            <input type="number" step="0.01" name="adicional_freestyle" value="{{ old('adicional_freestyle', 0) }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500">
        </div>

        <button type="submit" class="mt-2 bg-gold-500 hover:bg-gold-600 text-neutral-950 font-bold rounded-xl px-6 py-3 transition-all">
            Salvar Corte
        </button>
    </form>
</div>

@include('includes.footer')