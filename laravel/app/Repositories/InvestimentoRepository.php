<?php

namespace App\Repositories;

use App\Models\Investimento;
use App\Models\TipoInvestimento;
use App\Models\MovimentacaoInvestimento;
use Illuminate\Database\Eloquent\Collection;

class InvestimentoRepository
{
    public function getAllTipos(): Collection
    {
        return TipoInvestimento::all();
    }

    public function findOrCreateInvestimento(int $contaId, int $tipoInvestimentoId): Investimento
    {
        return Investimento::firstOrCreate(
            [
                'conta_id' => $contaId,
                'tipo_investimento_id' => $tipoInvestimentoId,
            ],
            ['valor' => 0]
        );
    }

    public function findByIdAndConta(int $investimentoId, int $contaId): ?Investimento
    {
        return Investimento::where('id', $investimentoId)
            ->where('conta_id', $contaId)
            ->first();
    }

    public function getInvestimentosByContaId(int $contaId): Collection
    {
        return Investimento::with('tipoInvestimento')
            ->where('conta_id', $contaId)
            ->get();
    }

    public function updateValor(Investimento $investimento, float $novoValor): bool
    {
        return $investimento->update(['valor' => $novoValor]);
    }

    public function createMovimentacao(array $data): MovimentacaoInvestimento
    {
        return MovimentacaoInvestimento::create($data);
    }
}