<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'sigla',
        'descricao'
    ];

    public function produtos(){
        return $this->hasMany(Produto::class);
    } 

}
