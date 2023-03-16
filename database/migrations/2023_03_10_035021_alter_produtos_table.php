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
        Schema::table('produtos', function (Blueprint $table) {        
            $table->integer('personaliza_numero')->default(0);            
            $table->integer('personaliza_nome')->default(0);              
            $table->integer('personaliza_modalidade')->default(0);                 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('personaliza_numero');
            $table->dropColumn('personaliza_nome');
            $table->dropColumn('personaliza_modalidade');
        });
    }
};
