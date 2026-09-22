<?php

namespace App\Services;

use App\Models\User;
use App\Models\Conta;
use App\Repositories\ContaRepository;
use App\Repositories\UserRepository;
use App\Mail\NovoUsuarioCadastradoMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;

class ContaService
{
    protected ContaRepository $contaRepository;
    protected UserRepository $userRepository;

    public function __construct(ContaRepository $contaRepository, UserRepository $userRepository)
    {
        $this->contaRepository = $contaRepository;
        $this->userRepository = $userRepository;
    }

    public function criarClienteComConta(array $dadosCliente, float $saldoInicial, float $limiteInicial): User
    {
        $roleCliente = $this->userRepository->findRoleByName('cliente');
        if (!$roleCliente) {
            throw new Exception('Role de cliente não encontrada.');
        }

        $senhaProvisoria = $dadosCliente['password'];

        $user = DB::transaction(function () use ($dadosCliente, $roleCliente, $saldoInicial, $limiteInicial) {
            $user = $this->userRepository->createUser([
                'name' => $dadosCliente['name'],
                'email' => $dadosCliente['email'],
                'password' => Hash::make($dadosCliente['password']),
                'role_id' => $roleCliente->id,
            ]);

            $this->contaRepository->createConta([
                'usuario_id' => $user->id,
                'saldo' => $saldoInicial,
                'limite' => $limiteInicial,
                'bloqueada' => false,
            ]);

            return $user;
        });

        Mail::to($user->email)->send(new NovoUsuarioCadastradoMail($user, $senhaProvisoria));

        return $user;
    }

    public function criarClienteComConta(array $dadosCliente, float $saldoInicial, float $limiteInicial, int $gerenteId): User
    {
        $roleCliente = $this->userRepository->findRoleByName('cliente');
        if (!$roleCliente) {
            throw new Exception('Role de cliente não encontrada.');
        }

        $senhaProvisoria = $dadosCliente['password'];

        $user = DB::transaction(function () use ($dadosCliente, $roleCliente, $saldoInicial, $limiteInicial, $gerenteId) {
            $user = $this->userRepository->createUser([
                'name' => $dadosCliente['name'],
                'email' => $dadosCliente['email'],
                'password' => Hash::make($dadosCliente['password']),
                'role_id' => $roleCliente->id,
            ]);

            $this->contaRepository->createConta([
                'usuario_id' => $user->id,
                'gerente_id' => $gerenteId,
                'saldo' => $saldoInicial,
                'limite' => $limiteInicial,
                'bloqueada' => false,
            ]);

            return $user;
        });

        Mail::to($user->email)->send(new NovoUsuarioCadastradoMail($user, $senhaProvisoria));

        return $user;
    }

    public function toggleBloqueio(Conta $conta): bool
    {
        return $this->contaRepository->setBloqueio($conta, !$conta->bloqueada);
    }
}