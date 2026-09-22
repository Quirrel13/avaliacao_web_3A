<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('gerente_id')->nullable()->after('usuario_id')->constrained('users')->onDelete('set null');
            $table->decimal('saldo', 15, 2)->default(0);
            $table->decimal('limite', 15, 2)->default(0);
            $table->boolean('bloqueada')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contas');
    }
};
