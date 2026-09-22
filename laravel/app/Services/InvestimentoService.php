<?php

namespace App\Services;

use App\Models\Conta;
use App\Models\Investimento;
use App\Repositories\InvestimentoRepository;
use Illuminate\Support\Facades\DB;
use Exception;

class InvestimentoService
{
    protected InvestimentoRepository $investimentoRepository;

    public function __construct(InvestimentoRepository $investimentoRepository)
    {
        $this->investimentoRepository = $investimentoRepository;
    }

    public function aplicar(Conta $conta, int $tipoInvestimentoId, float $valor): Investimento
    {
        if ($conta->bloqueada) {
            throw new Exception('Conta bloqueada por suspeita de fraude.');
        }

        if ($valor <= 0) {
            throw new Exception('O valor do investimento deve ser maior que zero.');
        }

        if ($conta->saldo < $valor) {
            throw new Exception('Saldo insuficiente para efetuar a aplicação.');
        }

        return DB::transaction(function () use ($conta, $tipoInvestimentoId, $valor) {
            $conta->decrement('saldo', $valor);

            $investimento = $this->investimentoRepository->findOrCreateInvestimento($conta->id, $tipoInvestimentoId);
            $novoValor = $investimento->valor + $valor;
            $this->investimentoRepository->updateValor($investimento, $novoValor);

            $this->investimentoRepository->createMovimentacao([
                'investimento_id' => $investimento->id,
                'tipo' => 'aplicacao',
                'valor' => $valor,
            ]);

            return $investimento;
        });
    }

    public function resgatar(Conta $conta, int $investimentoId, float $valor): Investimento
    {
        if ($conta->bloqueada) {
            throw new Exception('Conta bloqueada por suspeita de fraude.');
        }

        if ($valor <= 0) {
            throw new Exception('O valor de resgate deve ser maior que zero.');
        }

        $investimento = $this->investimentoRepository->findByIdAndConta($investimentoId, $conta->id);

        if (!$investimento) {
            throw new Exception('Investimento não encontrado para esta conta.');
        }

        if ($investimento->valor < $valor) {
            throw new Exception('Valor de resgate superior ao saldo aplicado.');
        }

        return DB::transaction(function () use ($conta, $investimento, $valor) {
            $novoValor = $investimento->valor - $valor;
            $this->investimentoRepository->updateValor($investimento, $novoValor);
            $conta->increment('saldo', $valor);

            $this->investimentoRepository->createMovimentacao([
                'investimento_id' => $investimento->id,
                'tipo' => 'resgate',
                'valor' => $valor,
            ]);

            return $investimento;
        });
    }
}