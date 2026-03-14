<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadeSeeder extends Seeder
{
    public function run(): void
    {
        $unidades = [
            ['sigla' => 'un',  'descricao' => 'Unidade'],
            ['sigla' => 'kg',  'descricao' => 'Quilograma'],
            ['sigla' => 'g',   'descricao' => 'Grama'],
            ['sigla' => 'L',   'descricao' => 'Litro'],
            ['sigla' => 'mL',  'descricao' => 'Mililitro'],
            ['sigla' => 'm',   'descricao' => 'Metro'],
            ['sigla' => 'cm',  'descricao' => 'Centímetro'],
            ['sigla' => 'cx',  'descricao' => 'Caixa'],
            ['sigla' => 'pç',  'descricao' => 'Peça'],
            ['sigla' => 'par', 'descricao' => 'Par'],
        ];

        foreach ($unidades as $unidade) {
            DB::table('unidades')->insertOrIgnore(array_merge($unidade, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
