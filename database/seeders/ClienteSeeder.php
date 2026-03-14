<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['nome' => 'Ana Silva',          'cpf' => '11122233344', 'telefone' => '41999990001', 'email' => 'ana.silva@email.com',       'endereco_id' => 1],
            ['nome' => 'Bruno Costa',        'cpf' => '22233344455', 'telefone' => '41999990002', 'email' => 'bruno.costa@email.com',     'endereco_id' => 2],
            ['nome' => 'Carla Mendes',       'cpf' => '33344455566', 'telefone' => '41999990003', 'email' => 'carla.mendes@email.com',    'endereco_id' => 3],
            ['nome' => 'Diego Ferreira',     'cpf' => '44455566677', 'telefone' => '41999990004', 'email' => 'diego.ferreira@email.com', 'endereco_id' => 4],
            ['nome' => 'Elena Rodrigues',    'cpf' => '55566677788', 'telefone' => '41999990005', 'email' => 'elena.rodrigues@email.com','endereco_id' => 5],
            ['nome' => 'Felipe Oliveira',    'cpf' => '66677788899', 'telefone' => '41999990006', 'email' => 'felipe.oliveira@email.com','endereco_id' => 6],
            ['nome' => 'Gabriela Santos',    'cpf' => '77788899900', 'telefone' => '41999990007', 'email' => 'gabriela.santos@email.com','endereco_id' => 7],
            ['nome' => 'Henrique Alves',     'cpf' => '88899900011', 'telefone' => '41999990008', 'email' => 'henrique.alves@email.com', 'endereco_id' => 8],
            ['nome' => 'Isabela Martins',    'cpf' => '99900011122', 'telefone' => '41999990009', 'email' => 'isabela.martins@email.com','endereco_id' => 9],
            ['nome' => 'João Pereira',       'cpf' => '00011122233', 'telefone' => '41999990010', 'email' => 'joao.pereira@email.com',   'endereco_id' => 10],
            ['nome' => 'Karina Lima',        'cpf' => '11100022233', 'telefone' => '41999990011', 'email' => 'karina.lima@email.com',    'endereco_id' => 11],
            ['nome' => 'Lucas Barbosa',      'cpf' => '22211133344', 'telefone' => '41999990012', 'email' => 'lucas.barbosa@email.com',  'endereco_id' => 12],
            ['nome' => 'Marina Carvalho',    'cpf' => '33322244455', 'telefone' => '41999990013', 'email' => 'marina.carvalho@email.com','endereco_id' => 13],
            ['nome' => 'Nicolas Souza',      'cpf' => '44433355566', 'telefone' => '41999990014', 'email' => 'nicolas.souza@email.com',  'endereco_id' => 14],
            ['nome' => 'Olivia Castro',      'cpf' => '55544466677', 'telefone' => '41999990015', 'email' => 'olivia.castro@email.com',  'endereco_id' => 15],
            ['nome' => 'Paulo Ribeiro',      'cpf' => '66655577788', 'telefone' => '41999990016', 'email' => 'paulo.ribeiro@email.com',  'endereco_id' => 1],
            ['nome' => 'Quintina Moreira',   'cpf' => '77766688899', 'telefone' => '41999990017', 'email' => 'quintina.moreira@email.com','endereco_id' => 2],
            ['nome' => 'Rafael Nunes',       'cpf' => '88877799900', 'telefone' => '41999990018', 'email' => 'rafael.nunes@email.com',   'endereco_id' => 3],
            ['nome' => 'Sofia Azevedo',      'cpf' => '99988800011', 'telefone' => '41999990019', 'email' => 'sofia.azevedo@email.com',  'endereco_id' => 4],
            ['nome' => 'Thiago Monteiro',    'cpf' => '10099911122', 'telefone' => '41999990020', 'email' => 'thiago.monteiro@email.com','endereco_id' => 5],
        ];

        foreach ($clientes as $cliente) {
            DB::table('clientes')->insertOrIgnore(array_merge($cliente, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
