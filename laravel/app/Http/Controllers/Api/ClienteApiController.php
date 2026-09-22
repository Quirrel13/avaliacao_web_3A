<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PixService;
use App\Services\InvestimentoService;
use Illuminate\Http\Request;
use Exception;

class ClienteApiController extends Controller
{
    protected PixService $pixService;
    protected InvestimentoService $investimentoService;

    public function __construct(PixService $pixService, InvestimentoService $investimentoService)
    {
        $this->pixService = $pixService;
        $this->investimentoService = $investimentoService;
    }

    // Visualização de Saldo em Tempo Real e Investimentos
    public function dashboard(Request $request)
    {
        $conta = $request->user()->conta()->with('investimentos.tipoInvestimento')->firstOrFail();

        return response()->json([
            'saldo' => $conta->saldo,
            'limite' => $conta->limite,
            'bloqueada' => $conta->bloqueada,
            'investimentos' => $conta->investimentos,
        ]);
    }

    // Realizar Operação de PIX
    public function realizarPix(Request $request)
    {
        $request->validate([
            'chave_pix' => 'required|string',
            'valor' => 'required|numeric|min:0.01',
        ]);

        try {
            $conta = $request->user()->conta;
            $pix = $this->pixService->realizarPix($conta, $request->chave_pix, $request->valor);

            return response()->json(['message' => 'PIX realizado com sucesso!', 'pix' => $pix]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Aplicar em Investimento (CDB, CDI, Poupança)
    public function aplicar(Request $request)
    {
        $request->validate([
            'tipo_investimento_id' => 'required|exists:tipos_investimento,id',
            'valor' => 'required|numeric|min:0.01',
        ]);

        try {
            $conta = $request->user()->conta;
            $investimento = $this->investimentoService->aplicar($conta, $request->tipo_investimento_id, $request->valor);

            return response()->json(['message' => 'Aplicação efetuada com sucesso!', 'investimento' => $investimento]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Resgatar Investimento
    public function resgatar(Request $request)
    {
        $request->validate([
            'investimento_id' => 'required|exists:investimentos,id',
            'valor' => 'required|numeric|min:0.01',
        ]);

        try {
            $conta = $request->user()->conta;
            $investimento = $this->investimentoService->resgatar($conta, $request->investimento_id, $request->valor);

            return response()->json(['message' => 'Resgate efetuado com sucesso!', 'investimento' => $investimento]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}