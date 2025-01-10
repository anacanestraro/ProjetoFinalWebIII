<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'cliente_id',
        'rua', 
        'cidade',   
        'estado',
        'bairro',
        'uf',
        'complemento'
    ];

}
