<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimentacoes_investimento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investimento_id')->constrained('investimentos');
            $table->enum('tipo', ['aplicacao', 'resgate']);
            $table->decimal('valor', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimentacoes_investimento');
    }
};
