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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',50);
            $table->string('produto',200);
            $table->text('descricao')->nullable();          
            $table->decimal('valor',10,2);                    
            $table->string('imagem1',200);                   
            $table->string('imagem2',200);                   
            $table->string('imagem3',200);                   
            $table->string('imagem_medidas',200);                   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
