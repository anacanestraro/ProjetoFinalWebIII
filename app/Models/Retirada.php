<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retirada extends Model
{
    use HasFactory;

    protected $fillable = [

        'id_cliente',
        'dataRetirada',
        'observacao'

    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function produtos(){
        return $this->belongsToMany(Produto::class, 'retirada_produtos')
        ->withPivot('quantidade', 'valorUnitario')
        ->withTimestamps();
    }
}
