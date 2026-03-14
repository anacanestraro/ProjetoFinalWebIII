<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [
            ['nome' => 'Arduino Uno',          'descricao' => 'Microcontrolador ATmega328P',     'estoque' => 15, 'valorUnitario' => 45.90,  'id_unidade' => 1, 'id_categoria' => 1],
            ['nome' => 'ESP-32',               'descricao' => 'Módulo Wi-Fi e Bluetooth',         'estoque' => 8,  'valorUnitario' => 32.00,  'id_unidade' => 1, 'id_categoria' => 1],
            ['nome' => 'Raspberry Pi 4',       'descricao' => 'Computador de placa única 4GB',   'estoque' => 4,  'valorUnitario' => 350.00, 'id_unidade' => 1, 'id_categoria' => 1],
            ['nome' => 'Sensor DHT22',         'descricao' => 'Sensor de temperatura e umidade', 'estoque' => 20, 'valorUnitario' => 18.50,  'id_unidade' => 1, 'id_categoria' => 1],
            ['nome' => 'Display LCD 16x2',     'descricao' => 'Display alfanumérico com I2C',    'estoque' => 12, 'valorUnitario' => 22.00,  'id_unidade' => 1, 'id_categoria' => 1],
            ['nome' => 'Chave Allen 6mm',      'descricao' => 'Chave hexagonal aço carbono',     'estoque' => 3,  'valorUnitario' => 8.90,   'id_unidade' => 1, 'id_categoria' => 2],
            ['nome' => 'Chave de Fenda P2',    'descricao' => 'Chave de fenda ponta Phillips',   'estoque' => 10, 'valorUnitario' => 12.00,  'id_unidade' => 1, 'id_categoria' => 2],
            ['nome' => 'Alicate Universal',    'descricao' => 'Alicate 8 polegadas boca chata',  'estoque' => 6,  'valorUnitario' => 35.00,  'id_unidade' => 1, 'id_categoria' => 2],
            ['nome' => 'Multímetro Digital',   'descricao' => 'Multímetro com sonda temperatura','estoque' => 2,  'valorUnitario' => 89.90,  'id_unidade' => 1, 'id_categoria' => 2],
            ['nome' => 'Parafuso M4x20',       'descricao' => 'Parafuso sextavado zincado',      'estoque' => 200,'valorUnitario' => 0.25,   'id_unidade' => 1, 'id_categoria' => 3],
            ['nome' => 'Parafuso M8x40',       'descricao' => 'Parafuso sextavado zincado',      'estoque' => 150,'valorUnitario' => 0.50,   'id_unidade' => 1, 'id_categoria' => 3],
            ['nome' => 'Arruela Zincada M6',   'descricao' => 'Arruela lisa zincada M6',         'estoque' => 0,  'valorUnitario' => 0.10,   'id_unidade' => 1, 'id_categoria' => 3],
            ['nome' => 'Porca M8',             'descricao' => 'Porca sextavada zincada M8',      'estoque' => 5,  'valorUnitario' => 0.20,   'id_unidade' => 1, 'id_categoria' => 3],
            ['nome' => 'Rolamento 6205',       'descricao' => 'Rolamento rígido de esferas',     'estoque' => 4,  'valorUnitario' => 28.00,  'id_unidade' => 1, 'id_categoria' => 4],
            ['nome' => 'Correia Dentada T5',   'descricao' => 'Correia dentada 500mm',           'estoque' => 7,  'valorUnitario' => 45.00,  'id_unidade' => 1, 'id_categoria' => 4],
            ['nome' => 'Cabo PP 2x1,5mm',      'descricao' => 'Cabo paralelo flexível 2 vias',   'estoque' => 30, 'valorUnitario' => 4.50,   'id_unidade' => 6, 'id_categoria' => 5],
            ['nome' => 'Disjuntor 20A',        'descricao' => 'Disjuntor termomagnético bipolar','estoque' => 9,  'valorUnitario' => 32.00,  'id_unidade' => 1, 'id_categoria' => 5],
            ['nome' => 'Tomada 2P+T',          'descricao' => 'Tomada embutir padrão NBR',       'estoque' => 18, 'valorUnitario' => 9.90,   'id_unidade' => 1, 'id_categoria' => 5],
            ['nome' => 'Capacete de Segurança','descricao' => 'Capacete classe A cor branca',    'estoque' => 5,  'valorUnitario' => 28.00,  'id_unidade' => 1, 'id_categoria' => 7],
            ['nome' => 'Óculos de Proteção',   'descricao' => 'Óculos ampla visão incolor',      'estoque' => 0,  'valorUnitario' => 15.00,  'id_unidade' => 1, 'id_categoria' => 7],
            ['nome' => 'Mouse USB',            'descricao' => 'Mouse óptico 1200 DPI',           'estoque' => 11, 'valorUnitario' => 49.90,  'id_unidade' => 1, 'id_categoria' => 8],
            ['nome' => 'Teclado USB ABNT2',    'descricao' => 'Teclado membrana padrão ABNT2',   'estoque' => 7,  'valorUnitario' => 79.90,  'id_unidade' => 1, 'id_categoria' => 8],
            ['nome' => 'Cabo HDMI 2m',         'descricao' => 'Cabo HDMI 2.0 alta velocidade',  'estoque' => 13, 'valorUnitario' => 24.90,  'id_unidade' => 1, 'id_categoria' => 8],
            ['nome' => 'Desinfetante 1L',      'descricao' => 'Desinfetante pinho concentrado',  'estoque' => 22, 'valorUnitario' => 6.50,   'id_unidade' => 4, 'id_categoria' => 9],
            ['nome' => 'Papel A4 Resma',       'descricao' => 'Papel sulfite 75g 500 folhas',    'estoque' => 40, 'valorUnitario' => 32.00,  'id_unidade' => 9, 'id_categoria' => 10],
        ];

        foreach ($produtos as $produto) {
            DB::table('produtos')->insertOrIgnore(array_merge($produto, [
                'imagem'         => 'nulo.jpg',
                'estoqueInicial' => $produto['estoque'],
                'created_at'     => now(),
                'updated_at'     => now(),
            ]));
        }
    }
}
