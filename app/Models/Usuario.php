<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $primaryKey = 'id';

    // O banco original não possui updated_at, apenas criado_em
    public $timestamps = true;
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = null;

    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    protected $hidden = [
        'senha',
    ];

    // Indica para o Laravel que o campo de senha no banco é 'senha' e não 'password'
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
