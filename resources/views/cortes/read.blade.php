@php
$success_message = '';
$error_message = '';
$status = request()->query('status');
if ($status == 'created') {
    $success_message = 'Corte cadastrado com sucesso!';
} elseif ($status == 'updated') {
    $success_message = 'Corte atualizado com sucesso!';
} elseif ($status == 'deleted') {
    $success_message = 'Corte excluído com sucesso!';
} elseif ($status == 'error') {
    $error_message = 'Ocorreu um erro ao processar a requisição.';
}
@endphp

@include('includes.header', ['page_title' => 'Lista de Cortes', 'active_tab' => 'cortes'])

<!-- Header do Módulo -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-extrabold text-white tracking-tight flex items-center gap-2">
            <i class="fa-solid fa-cut text-gold-500"></i>
            Catálogo de Cortes
        </h1>
        <p class="text-neutral-400 mt-1 text-sm">Gerencie os estilos de cabelo disponíveis e suas tabelas de preço.</p>
    </div>
    <div>
        <a href="create.php" class="px-5 py-2.5 bg-gold-500 hover:bg-gold-600 text-neutral-950 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2">
            <i class="fa-solid fa-plus text-xs"></i> Cadastrar Novo Corte
        </a>
    </div>
</div>

<!-- Alertas de Feedback -->
@if(!empty($success_message))
    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
        <i class="fa-solid fa-circle-check text-lg"></i>
        <span class="text-sm font-semibold">{{ $success_message }}</span>
    </div>
@endif

@if(!empty($error_message))
    <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 flex items-center gap-3">
        <i class="fa-solid fa-triangle-exclamation text-lg"></i>
        <span class="text-sm font-semibold">{{ $error_message }}</span>
    </div>
@endif

<!-- Tabela de Cortes -->
<div class="glass-card rounded-2xl overflow-hidden">
    @if(count($cortes) === 0)
        <!-- Estado Vazio (Sem cortes predefinidos) -->
        <div class="p-12 text-center">
            <div class="w-16 h-16 rounded-full bg-neutral-900 border border-neutral-800 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-scissors text-neutral-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-white mb-1">Nenhum corte cadastrado</h3>
            <p class="text-neutral-500 text-sm max-w-sm mx-auto mb-6">Comece cadastrando um novo estilo de corte de cabelo para ser oferecido na barbearia.</p>
            <a href="create.php" class="px-4 py-2 bg-neutral-900 hover:bg-neutral-800 border border-neutral-800 text-gold-500 hover:text-gold-400 rounded-xl text-sm font-semibold transition-all">
                Cadastrar Primeiro Corte
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-neutral-800 bg-neutral-900/40">
                        <th class="px-6 py-4 text-xs font-bold text-neutral-400 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-neutral-400 uppercase tracking-wider">Nome do Corte</th>
                        <th class="px-6 py-4 text-xs font-bold text-neutral-400 uppercase tracking-wider">Valor Base</th>
                        <th class="px-6 py-4 text-xs font-bold text-neutral-400 uppercase tracking-wider">Valor Adicional Freestyle</th>
                        <th class="px-6 py-4 text-xs font-bold text-neutral-400 uppercase tracking-wider text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-900/60">
                    @foreach($cortes as $corte)
                        <tr class="hover:bg-neutral-900/25 transition-colors duration-150">
                            <td class="px-6 py-4 text-sm font-semibold text-neutral-500">#{{ $corte->id }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-white">{{ $corte->nome_corte }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-emerald-400">R$ {{ number_format($corte->valor, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-amber-400">R$ {{ number_format($corte->adicional_freestyle, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-right space-x-2">
                                <a href="update.php?id={{ $corte->id }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-neutral-900 hover:bg-neutral-800 text-neutral-400 hover:text-white border border-neutral-800 hover:border-neutral-700 transition-all" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="delete.php?id={{ $corte->id }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 hover:text-rose-300 border border-rose-500/20 transition-all" title="Excluir">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@include('includes.footer')