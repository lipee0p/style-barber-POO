<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('id', 'desc')->get();
        return view('usuarios.read', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'senha' => 'required|min:6',
        ]);

        $email = trim($request->input('email'));

        // Verifica duplicidade
        if (Usuario::where('email', $email)->exists()) {
            return back()->withErrors(['erro' => 'Este e-mail já está sendo utilizado.'])->withInput();
        }

        Usuario::create([
            'nome' => trim($request->input('nome')),
            'email' => $email,
            'senha' => Hash::make($request->input('senha')),
        ]);

        return redirect()->to('/usuarios/read.php?status=created');
    }

    public function edit(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $usuario = Usuario::findOrFail($id);

        return view('usuarios.update', compact('usuario'));
    }

    public function update(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'senha' => 'nullable|min:6',
        ]);

        $email = trim($request->input('email'));

        // Verifica duplicidade para outro usuário
        if (Usuario::where('email', $email)->where('id', '!=', $id)->exists()) {
            return back()->withErrors(['erro' => 'Este e-mail já está em uso por outro usuário.'])->withInput();
        }

        $data = [
            'nome' => trim($request->input('nome')),
            'email' => $email,
        ];

        if ($request->filled('senha')) {
            $data['senha'] = Hash::make($request->input('senha'));
        }

        $usuario->update($data);

        return redirect()->to('/usuarios/read.php?status=updated');
    }

    public function destroy(Request $request)
    {
        $id = intval($request->query('id') ?? 0);
        $usuario = Usuario::findOrFail($id);

        // Se ainda não confirmou, mostra a tela de confirmação
        if (!$request->query('confirm')) {
            return view('usuarios.delete', compact('usuario'));
        }

        $usuario->delete();

        return redirect()->to('/usuarios/read.php?status=deleted');
    }
}