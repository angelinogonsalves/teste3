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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();            
            $table->string('razao_social',100);
            $table->string('nome_fantasia',100)->nullable();
            $table->string('cnpj',15)->nullable();                        
            $table->string('email',100)->nullable();
            $table->string('telefone',15)->nullable();
            $table->string('endereco',150)->nullable();
            $table->string('numero',10)->nullable();
            $table->string('bairro',100)->nullable();
            $table->string('cep',8)->nullable();
            $table->string('cidade',100)->nullable();
            $table->string('uf',2)->nullable();          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
