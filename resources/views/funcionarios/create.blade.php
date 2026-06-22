@include('includes.header', ['page_title' => 'Novo Funcionário', 'active_tab' => 'funcionarios'])

<div class="max-w-2xl">
    <h1 class="text-3xl font-extrabold text-white mb-8">Novo Colaborador</h1>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('funcionarios.store') }}" class="glass-card rounded-2xl p-8 flex flex-col gap-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Nome</label>
            <input type="text" name="nome" value="{{ old('nome') }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Função</label>
            <input type="text" name="funcao" value="{{ old('funcao') }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-neutral-300 mb-2">Data de Admissão</label>
                <input type="date" name="data_admissao" value="{{ old('data_admissao') }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-neutral-300 mb-2">Data de Nascimento</label>
                <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Salário (R$)</label>
            <input type="number" step="0.01" name="salario" value="{{ old('salario') }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <button type="submit" class="mt-2 bg-gold-500 hover:bg-gold-600 text-neutral-950 font-bold rounded-xl px-6 py-3 transition-all">
            Salvar Funcionário
        </button>
    </form>
</div>

@include('includes.footer')