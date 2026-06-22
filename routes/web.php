<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CorteController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\UsuarioController;

// Rota de Boas-vindas ou redirecionamento para o dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Autenticação e Registro Administrativo
Route::get('/login.php', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login.php', [AuthController::class, 'login']);
Route::get('/cadastro.php', [AuthController::class, 'showCadastro'])->name('cadastro');
Route::post('/cadastro.php', [AuthController::class, 'cadastro']);
Route::get('/logout.php', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas (Acesso administrativo)
Route::middleware('auth')->group(function () {
    
    // Dashboard Geral
    Route::get('/index.php', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD - Cortes
    Route::get('/cortes/read.php', [CorteController::class, 'index'])->name('cortes.index');
    Route::get('/cortes/create.php', [CorteController::class, 'create'])->name('cortes.create');
    Route::post('/cortes/create.php', [CorteController::class, 'store'])->name('cortes.store');
    Route::get('/cortes/update.php', [CorteController::class, 'edit'])->name('cortes.edit');
    Route::post('/cortes/update.php', [CorteController::class, 'update'])->name('cortes.update');
    Route::get('/cortes/delete.php', [CorteController::class, 'destroy'])->name('cortes.destroy');

    // CRUD - Clientes
    Route::get('/clientes/read.php', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create.php', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes/create.php', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/update.php', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::post('/clientes/update.php', [ClienteController::class, 'update'])->name('clientes.update');
    Route::get('/clientes/delete.php', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    // CRUD - Funcionários
    Route::get('/funcionarios/read.php', [FuncionarioController::class, 'index'])->name('funcionarios.index');
    Route::get('/funcionarios/create.php', [FuncionarioController::class, 'create'])->name('funcionarios.create');
    Route::post('/funcionarios/create.php', [FuncionarioController::class, 'store'])->name('funcionarios.store');
    Route::get('/funcionarios/update.php', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
    Route::post('/funcionarios/update.php', [FuncionarioController::class, 'update'])->name('funcionarios.update');
    Route::get('/funcionarios/delete.php', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');

    // CRUD - Usuários
    Route::get('/usuarios/read.php', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create.php', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios/create.php', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/update.php', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::post('/usuarios/update.php', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::get('/usuarios/delete.php', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});
