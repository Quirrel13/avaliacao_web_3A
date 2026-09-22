<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Services\ContaService;
use App\Repositories\ContaRepository;
use App\Repositories\SolicitacaoRepository;
use Illuminate\Http\Request;

class GerenteContaController extends Controller
{
    protected ContaService $contaService;
    protected ContaRepository $contaRepository;
    protected SolicitacaoRepository $solicitacaoRepository;

    public function __construct(
        ContaService $contaService,
        ContaRepository $contaRepository,
        SolicitacaoRepository $solicitacaoRepository
    ) {
        $this->contaService = $contaService;
        $this->contaRepository = $contaRepository;
        $this->solicitacaoRepository = $solicitacaoRepository;
    }

    public function indexClientes()
    {
        $contas = $this->contaRepository->getAllContasWithUser();

        return view('gerente_conta.clientes.index', compact('contas'));
    }

    public function storeCliente(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'saldo' => 'required|numeric|min:0',
            'limite' => 'required|numeric|min:0',
        ]);

        $this->contaService->criarClienteComConta(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ],
            $request->saldo,
            $request->limite,
            auth()->id()
        );

        return redirect()->back()->with('success', 'Cliente e conta criados com sucesso!');
    }

    public function solicitarAumentoLimite(Request $request, Conta $conta)
    {
        $request->validate(['novo_limite' => 'required|numeric|gt:' . $conta->limite]);

        $this->solicitacaoRepository->create([
            'conta_id' => $conta->id,
            'gerente_conta_id' => auth()->id(),
            'limite_solicitado' => $request->novo_limite,
            'status' => 'pendente',
        ]);

        return redirect()->back()->with('success', 'Solicitação de aumento enviada ao Gerente Geral.');
    }

    public function toggleBloqueio(Conta $conta)
    {
        $this->contaService->toggleBloqueio($conta);

        return redirect()->back()->with('success', 'Status de bloqueio alterado.');
    }
}