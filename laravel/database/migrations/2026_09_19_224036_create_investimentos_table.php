<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conta_id')->constrained('contas');
            $table->foreignId('tipo_investimento_id')->constrained('tipos_investimento');
            $table->decimal('valor', 15, 2)->default(0);
            $table->timestamps();

            $table->unique(['conta_id', 'tipo_investimento_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investimentos');
    }
};
