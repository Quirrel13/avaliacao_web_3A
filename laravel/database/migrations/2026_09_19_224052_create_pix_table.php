<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pix', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conta_origem_id')->constrained('contas');
            $table->foreignId('conta_destino_id')->constrained('contas');
            $table->decimal('valor', 15, 2);
            $table->string('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pix');
    }
};
