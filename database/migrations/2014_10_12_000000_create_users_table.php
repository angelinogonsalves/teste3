<?php

use App\Models\Unidade;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('tipo_usuario');    
            $table->foreignIdFor(Unidade::class)->nullable();            
            $table->string('telefone',12)->nullable();
            $table->string('endereco',100)->nullable();
            $table->string('numero',10)->nullable();
            $table->string('bairro',100)->nullable();
            $table->string('cep',8)->nullable();
            $table->string('cidade',100)->nullable();
            $table->string('uf',2)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
