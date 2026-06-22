<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'horario_agendamento',
        'forma_pagamento',
        'corte_id', 
    ];

    public function corte()
    {
        return $this->belongsTo(Corte::class, 'corte_id');
    }
}
