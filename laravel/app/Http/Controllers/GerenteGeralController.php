<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Solicitacao;
use App\Models\LogAuditoria;
use App\Mail\NovoUsuarioCadastradoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class GerenteGeralController extends Controller
{
    /**
     * Lista todos os Gerentes de Conta cadastrados.
     */
    public function indexGerentes()
    {
        $roleGerenteConta = Role::where('name', 'gerente_conta')->first();
        $gerentes = User::where('role_id', $roleGerenteConta?->id)->get();

        return view('gerente_geral.gerentes', compact('gerentes'));
    }

    /**
     * Cadastra um novo Gerente de Conta e envia e-mail com credenciais.
     */
    public function storeGerente(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $roleGerenteConta = Role::where('name', 'gerente_conta')->first();

        $gerente = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleGerenteConta->id,
        ]);

        // Disparo do e-mail de boas-vindas
        Mail::to($gerente->email)->send(new NovoUsuarioCadastradoMail($gerente, $request->password));

        return redirect()->back()->with('success', 'Gerente de Conta cadastrado e e-mail enviado com sucesso!');
    }

    /**
     * Lista solicitações pendentes (como aumento de limite).
     */
    public function solicitacoes()
    {
        $solicitacoes = Solicitacao::with('conta.user')->where('status', 'pendente')->get();

        return view('gerente_geral.solicitacoes', compact('solicitacoes'));
    }

    /**
     * Aprova ou nega uma solicitação de limite/ajuste.
     */
    public function avaliarSolicitacao(Request $request, $solicitacaoId)
    {
        $request->validate([
            'status' => 'required|in:aprovado,rejeitado',
        ]);

        $solicitacao = Solicitacao::findOrFail($solicitacaoId);
        $solicitacao->status = $request->status;
        $solicitacao->save();

        if ($request->status === 'aprovado') {
            $conta = $solicitacao->conta;
            $conta->limite = $solicitacao->novo_limite;
            $conta->save();
        }

        return redirect()->back()->with('success', 'Solicitação avaliada com sucesso!');
    }

    /**
     * Exibe o histórico de logs do sistema/auditoria.
     */
    public function logsAuditoria()
    {
        $logs = LogAuditoria::with('user')->latest()->paginate(20);

        return view('gerente_geral.logs', compact('logs'));
    }
}