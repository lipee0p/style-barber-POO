@include('includes.header', ['page_title' => 'Editar Usuário', 'active_tab' => 'usuarios'])

<div class="max-w-2xl">
    <h1 class="text-3xl font-extrabold text-white mb-8">Editar Usuário</h1>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/usuarios/update.php?id=' . $usuario->id) }}" class="glass-card rounded-2xl p-8 flex flex-col gap-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Nome</label>
            <input type="text" name="nome" value="{{ old('nome', $usuario->nome) }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">E-mail</label>
            <input type="email" name="email" value="{{ old('email', $usuario->email) }}" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-300 mb-2">Nova Senha</label>
            <input type="password" name="senha" class="w-full bg-neutral-900 border border-neutral-800 text-white rounded-xl px-4 py-3 outline-none focus:border-gold-500" minlength="6">
            <p class="text-xs text-neutral-500 mt-1">Deixe em branco para manter a senha atual.</p>
        </div>

        <button type="submit" class="mt-2 bg-gold-500 hover:bg-gold-600 text-neutral-950 font-bold rounded-xl px-6 py-3 transition-all">
            Atualizar Usuário
        </button>
    </form>
</div>

@include('includes.footer')