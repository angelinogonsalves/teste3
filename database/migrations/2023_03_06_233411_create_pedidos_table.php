<?php

use App\Http\Services\AlunoService;
use App\Models\Unidade;
use App\Models\User;
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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Unidade::class);            
            $table->foreignIdFor(User::class)->nullable();
            $table->string('nome_aluno',100)->nullable();              
            $table->string('ra_aluno',50)->nullable();              
            $table->integer('status');              
            $table->decimal('valor',10,2); 
            $table->string('id_pagseguro',300)->nullable(); 
            $table->string('cod_referencia',300)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
