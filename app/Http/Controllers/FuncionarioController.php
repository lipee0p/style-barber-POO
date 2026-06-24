<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::orderBy('id', 'desc')->get();
        return view('funcionarios.read', compact('funcionarios'));
    }

    public function create()
    {
        return view('funcionarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'funcao' => 'required|string|max:100',
            'data_admissao' => 'required|date',
            'data_nascimento' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        Funcionario::create([
            'nome' => $request->input('nome'),
            'funcao' => $request->input('funcao'),
            'data_admissao' => $request->input('data_admissao'),
            'data_nascimento' => $request->input('data_nascimento'),
            'salario' => $request->input('salario'),
        ]);

        return redirect()->to('/funcionarios/read.php?status=created');
    }

    public function edit(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $funcionario = Funcionario::findOrFail($id);

        return view('funcionarios.update', compact('funcionario'));
    }

    public function update(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $funcionario = Funcionario::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:100',
            'funcao' => 'required|string|max:100',
            'data_admissao' => 'required|date',
            'data_nascimento' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        $funcionario->update([
            'nome' => $request->input('nome'),
            'funcao' => $request->input('funcao'),
            'data_admissao' => $request->input('data_admissao'),
            'data_nascimento' => $request->input('data_nascimento'),
            'salario' => $request->input('salario'),
        ]);

        return redirect()->to('/funcionarios/read.php?status=updated');
    }

    public function destroy(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $funcionario = Funcionario::findOrFail($id);

        // Se ainda não confirmou, mostra a tela de confirmação
        if (!$request->query('confirm')) {
            return view('funcionarios.delete', compact('funcionario'));
        }

        $funcionario->delete();

        return redirect()->to('/funcionarios/read.php?status=deleted');
    }
}