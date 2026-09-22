<?php

namespace App\Services;

use App\Models\Conta;
use App\Models\Pix;
use App\Repositories\ContaRepository;
use App\Repositories\PixRepository;
use Illuminate\Support\Facades\DB;
use Exception;

class PixService
{
    protected ContaRepository $contaRepository;
    protected PixRepository $pixRepository;

    public function __construct(ContaRepository $contaRepository, PixRepository $pixRepository)
    {
        $this->contaRepository = $contaRepository;
        $this->pixRepository = $pixRepository;
    }

    public function realizarPix(Conta $contaOrigem, string $chavePixDestino, float $valor, ?string $descricao = null): Pix
    {
        if ($contaOrigem->bloqueada) {
            throw new Exception('Conta bloqueada por suspeita de fraude.');
        }

        if ($valor <= 0) {
            throw new Exception('O valor do PIX deve ser maior que zero.');
        }

        $usuarioDestino = $this->contaRepository->findUserByEmail($chavePixDestino);

        if (!$usuarioDestino || !$usuarioDestino->conta) {
            throw new Exception('Chave PIX não encontrada.');
        }

        $contaDestino = $usuarioDestino->conta;

        if ($contaDestino->id === $contaOrigem->id) {
            throw new Exception('Não é possível fazer PIX para a própria conta.');
        }

        if ($contaDestino->bloqueada) {
            throw new Exception('A conta de destino está bloqueada e não pode receber PIX.');
        }

        if (($contaOrigem->saldo + $contaOrigem->limite) < $valor) {
            throw new Exception('Saldo e limite insuficientes para realizar o PIX.');
        }

        return DB::transaction(function () use ($contaOrigem, $contaDestino, $valor, $descricao) {
            $this->contaRepository->update($contaOrigem->id, ['saldo' => $contaOrigem->saldo - $valor]);
            $this->contaRepository->update($contaDestino->id, ['saldo' => $contaDestino->saldo + $valor]);

            return $this->pixRepository->create([
                'conta_origem_id' => $contaOrigem->id,
                'conta_destino_id' => $contaDestino->id,
                'valor' => $valor,
                'descricao' => $descricao,
            ]);
        });
    }
}