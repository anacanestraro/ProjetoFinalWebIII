<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnderecoSeeder extends Seeder
{
    public function run(): void
    {
        $enderecos = [
            ['cep' => '80010000', 'rua' => 'Rua XV de Novembro',    'numero' => '100', 'bairro' => 'Centro',        'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '80250000', 'rua' => 'Av. Sete de Setembro',  'numero' => '250', 'bairro' => 'Batel',         'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '80420000', 'rua' => 'Rua Marechal Deodoro',  'numero' => '45',  'bairro' => 'Centro Cívico', 'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '83005000', 'rua' => 'Rua das Flores',        'numero' => '321', 'bairro' => 'Jardim Primav.','cidade' => 'São José dos Pinhais', 'uf' => 'PR'],
            ['cep' => '83010000', 'rua' => 'Av. Rui Barbosa',       'numero' => '780', 'bairro' => 'Centro',        'cidade' => 'São José dos Pinhais', 'uf' => 'PR'],
            ['cep' => '80710000', 'rua' => 'Rua Comendador Araújo', 'numero' => '12',  'bairro' => 'Bigorrilho',    'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '80050000', 'rua' => 'Rua Amintas de Barros', 'numero' => '567', 'bairro' => 'Alto da Rua XV','cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '82560000', 'rua' => 'Av. Prefeito Maurício', 'numero' => '890', 'bairro' => 'Cajuru',        'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '81540000', 'rua' => 'Rua Deputado Heitor',   'numero' => '33',  'bairro' => 'Cidade Ind.',   'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '80730000', 'rua' => 'Rua João Negrão',       'numero' => '200', 'bairro' => 'Centro',        'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '80035000', 'rua' => 'Rua Ébano Pereira',     'numero' => '411', 'bairro' => 'Centro',        'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '80240000', 'rua' => 'Rua Padre Agostinho',   'numero' => '88',  'bairro' => 'Mercês',        'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '82920000', 'rua' => 'Rua João Bettega',      'numero' => '150', 'bairro' => 'Portão',        'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '81200000', 'rua' => 'Av. Winston Churchill', 'numero' => '620', 'bairro' => 'Pinheirinho',   'cidade' => 'Curitiba',       'uf' => 'PR'],
            ['cep' => '80320000', 'rua' => 'Rua Carlos de Carvalho','numero' => '77',  'bairro' => 'Centro',        'cidade' => 'Curitiba',       'uf' => 'PR'],
        ];

        foreach ($enderecos as $endereco) {
            DB::table('enderecos')->insertOrIgnore(array_merge($endereco, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
