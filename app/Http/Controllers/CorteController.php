<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corte;

class CorteController extends Controller
{
    public function index(Request $request)
    {
        $cortes = Corte::orderBy('id', 'desc')->get();
        return view('cortes.read', compact('cortes'));
    }

    public function create()
    {
        return view('cortes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_corte' => 'required|string|max:100',
            'valor' => 'required|numeric|min:0',
            'adicional_freestyle' => 'nullable|numeric|min:0',
        ]);

        Corte::create([
            'nome_corte' => $request->input('nome_corte'),
            'valor' => $request->input('valor'),
            'adicional_freestyle' => $request->input('adicional_freestyle') ?? 0,
        ]);

        return redirect()->to('/cortes/read.php?status=created');
    }

    public function edit(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $corte = Corte::findOrFail($id);

        return view('cortes.update', compact('corte'));
    }

    public function update(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $corte = Corte::findOrFail($id);

        $request->validate([
            'nome_corte' => 'required|string|max:100',
            'valor' => 'required|numeric|min:0',
            'adicional_freestyle' => 'nullable|numeric|min:0',
        ]);

        $corte->update([
            'nome_corte' => $request->input('nome_corte'),
            'valor' => $request->input('valor'),
            'adicional_freestyle' => $request->input('adicional_freestyle') ?? 0,
        ]);

        return redirect()->to('/cortes/read.php?status=updated');
    }

    public function destroy(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $corte = Corte::findOrFail($id);

        // Se ainda não confirmou, mostra a tela de confirmação
        if (!$request->query('confirm')) {
            return view('cortes.delete', compact('corte'));
        }

        $corte->delete();

        return redirect()->to('/cortes/read.php?status=deleted');
    }
}