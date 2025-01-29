<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'cep',
        'rua', 
        'cidade',  
        'numero', 
        'bairro',
        'uf'
    ];

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }

}
