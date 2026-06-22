<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = trim($request->input('email'));
        $password = trim($request->input('password'));

        // Laravel Auth::attempt usa o UserProvider configurado (Usuario)
        // O Usuario model retorna a senha por getAuthPassword() (coluna 'senha')
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'erro' => 'E-mail ou senha inválidos. Tente novamente.'
        ])->withInput($request->only('email'));
    }

    public function showCadastro()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('cadastro');
    }

    public function cadastro(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'senha' => 'required|min:6',
            'confirma' => 'required',
        ]);

        $nome = trim($request->input('nome'));
        $email = trim($request->input('email'));
        $senha = $request->input('senha');
        $confirma = $request->input('confirma');

        if ($senha !== $confirma) {
            return back()->withErrors(['erro' => 'As senhas não coincidem.'])->withInput();
        }

        // Verifica se o e-mail já existe
        if (Usuario::where('email', $email)->exists()) {
            return back()->withErrors(['erro' => 'Este e-mail já está cadastrado.'])->withInput();
        }

        // Cria o usuário
        Usuario::create([
            'nome' => $nome,
            'email' => $email,
            'senha' => Hash::make($senha),
        ]);

        return redirect()->route('login')->with('sucesso', 'Conta criada com sucesso!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
