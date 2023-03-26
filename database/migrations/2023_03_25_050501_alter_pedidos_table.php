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
        Schema::table('pedidos', function (Blueprint $table) {        
            $table->string('tipo_pagamento',2)->nullable();            
            $table->string('id_qrcode',200)->nullable();                 
            $table->decimal('total_recebido',10,2)->nullable();      
            $table->decimal('total_liquido',10,2)->nullable();      
            $table->dateTime('data_pagamento')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tipo_pagamento');
            $table->dropColumn('id_qrcode');
            $table->dropColumn('total_recebido');
            $table->dropColumn('total_liquido');
            $table->dropColumn('data_pagamento');
        });
    }
};
