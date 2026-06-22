<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Corte;
use App\Models\Cliente;
use App\Models\Funcionario;

class DashboardController extends Controller
{
    public function index()
    {
        $total_usuarios = Usuario::count();
        $total_cortes = Corte::count();
        $total_clientes = Cliente::count();
        $total_funcionarios = Funcionario::count();

        return view('index', compact(
            'total_usuarios',
            'total_cortes',
            'total_clientes',
            'total_funcionarios'
        ));
    }
}
