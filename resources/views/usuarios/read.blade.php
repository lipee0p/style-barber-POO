@include('includes.header', ['page_title' => 'Usuários', 'active_tab' => 'usuarios'])

<div class="mb-10 flex items-center justify-between">
    <h1 class="text-3xl font-extrabold text-white">Acessos Administrativos</h1>
    <a href="{{ url('/usuarios/create.php') }}" class="px-4 py-2 bg-gold-500 hover:bg-gold-600 text-neutral-950 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Novo Usuário
    </a>
</div>

@if(request('status') == 'created')
    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">Usuário cadastrado com sucesso!</div>
@elseif(request('status') == 'updated')
    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">Usuário atualizado com sucesso!</div>
@elseif(request('status') == 'deleted')
    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">Usuário removido com sucesso!</div>
@endif

<div class="glass-card rounded-2xl overflow-hidden">
    <table class="w-full text-left">
        <thead>
            <tr class="border-b border-neutral-800 text-neutral-400 text-xs uppercase tracking-wider">
                <th class="px-6 py-4">Nome</th>
                <th class="px-6 py-4">E-mail</th>
                <th class="px-6 py-4 text-right">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
                <tr class="border-b border-neutral-800/50 hover:bg-neutral-900/30">
                    <td class="px-6 py-4 text-white font-medium">{{ $usuario->nome }}</td>
                    <td class="px-6 py-4 text-neutral-300">{{ $usuario->email }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ url('/usuarios/update.php?id=' . $usuario->id) }}" class="text-gold-500 hover:text-gold-400 mr-3">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a href="{{ url('/usuarios/delete.php?id=' . $usuario->id) }}"
                           onclick="return confirm('Tem certeza que deseja excluir este usuário?');"
                           class="text-red-500 hover:text-red-400">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-neutral-500">
                        Nenhum usuário cadastrado ainda.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('includes.footer')