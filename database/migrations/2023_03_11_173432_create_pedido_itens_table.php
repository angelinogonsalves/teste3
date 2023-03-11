<?php

use App\Models\Modalidade;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Tamanho;
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
        Schema::create('pedido_itens', function (Blueprint $table) {

            $table->id();

            $table->foreignIdFor(Pedido::class); 
            $table->foreignIdFor(Produto::class);                       
            $table->foreignIdFor(Tamanho::class);                       
            $table->integer('quantidade');             
            $table->decimal('valor_unitario',10,2);         
            $table->foreignIdFor(Modalidade::class)->nullable();                                               
            $table->string('nome_personalizado',50)->nullable(); 
            $table->string('numero_personalizado',10)->nullable();                                     
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_itens');
    }
};
