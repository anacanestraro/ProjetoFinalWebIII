<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->string('rua', 255);
            $table->string('cidade', 40);
            $table->string('estado', 40);
            $table->string('bairro', 255);
            $table->string('uf', 20);
            $table->string('complemento', 255);
            $table->timestamps();
            
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
