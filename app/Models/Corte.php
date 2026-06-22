<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    protected $table = 'cortes';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nome_corte',
        'valor',
        'adicional_freestyle',
    ];
}
