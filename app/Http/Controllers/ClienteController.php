<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Corte;

class ClienteController extends Controller
{
    public function index()
    {
        $agendamentos = Cliente::with('corte')->orderBy('horario_agendamento', 'asc')->get();
        return view('clientes.read', compact('agendamentos'));
    }

    public function create()
    {
        $cortes = Corte::orderBy('nome_corte', 'asc')->get();
        return view('clientes.create', compact('cortes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'horario_agendamento' => 'required',
            'forma_pagamento' => 'required|string|max:50',
            'corte_id' => 'nullable|integer',
        ]);

        Cliente::create([
            'nome' => $request->input('nome'),
            'horario_agendamento' => $request->input('horario_agendamento'),
            'forma_pagamento' => $request->input('forma_pagamento'),
            'corte_id' => $request->input('corte_id') ?: null,
        ]);

        return redirect()->to('/clientes/read.php?status=created');
    }

    public function edit(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $agendamento = Cliente::findOrFail($id);
        $cortes = Corte::orderBy('nome_corte', 'asc')->get();

        return view('clientes.update', compact('agendamento', 'cortes'));
    }

    public function update(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $agendamento = Cliente::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:100',
            'horario_agendamento' => 'required',
            'forma_pagamento' => 'required|string|max:50',
            'corte_id' => 'nullable|integer',
        ]);

        $agendamento->update([
            'nome' => $request->input('nome'),
            'horario_agendamento' => $request->input('horario_agendamento'),
            'forma_pagamento' => $request->input('forma_pagamento'),
            'corte_id' => $request->input('corte_id') ?: null,
        ]);

        return redirect()->to('/clientes/read.php?status=updated');
    }

    public function destroy(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $agendamento = Cliente::findOrFail($id);
        $agendamento->delete();

        return redirect()->to('/clientes/read.php?status=deleted');
    }
}
