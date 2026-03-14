<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Eletrônicos',    'descricao' => 'Componentes e dispositivos eletrônicos'],
            ['nome' => 'Ferramentas',    'descricao' => 'Ferramentas manuais e elétricas'],
            ['nome' => 'Fixação',        'descricao' => 'Parafusos, porcas, arruelas e afins'],
            ['nome' => 'Mecânica',       'descricao' => 'Peças e componentes mecânicos'],
            ['nome' => 'Elétrica',       'descricao' => 'Materiais e componentes elétricos'],
            ['nome' => 'Hidráulica',     'descricao' => 'Tubos, conexões e válvulas'],
            ['nome' => 'EPI',            'descricao' => 'Equipamentos de proteção individual'],
            ['nome' => 'Informática',    'descricao' => 'Periféricos e acessórios de informática'],
            ['nome' => 'Limpeza',        'descricao' => 'Produtos e materiais de limpeza'],
            ['nome' => 'Escritório',     'descricao' => 'Materiais de escritório e papelaria'],
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insertOrIgnore(array_merge($categoria, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
