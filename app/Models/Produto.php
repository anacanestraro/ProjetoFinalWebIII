<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem',
        'estoque',
        'descricao',
        'valorUnitario',
        'id_unidade',
        'id_categoria',
    ];

    public function unidade(){
        return $this->belongsTo(Unidade::class, 'id_unidade');
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
