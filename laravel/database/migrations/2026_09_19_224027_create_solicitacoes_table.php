<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conta_id')->constrained('contas');
            $table->foreignId('gerente_conta_id')->constrained('users'); // quem solicitou
            $table->foreignId('gerente_geral_id')->nullable()->constrained('users'); // quem decidiu
            $table->decimal('limite_solicitado', 15, 2);
            $table->enum('status', ['pendente', 'aprovada', 'reprovada'])->default('pendente');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitacoes');
    }
};
