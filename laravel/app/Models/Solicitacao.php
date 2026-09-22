<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Solicitacao extends Model implements Auditable
{
    use AuditableTrait;

    protected $table = 'solicitacoes';

    protected $fillable = [
        'conta_id', 'gerente_conta_id', 'gerente_geral_id',
        'limite_solicitado', 'status', 'observacao',
    ];

    protected function casts(): array
    {
        return ['limite_solicitado' => 'decimal:2'];
    }

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }

    public function gerenteConta()
    {
        return $this->belongsTo(User::class, 'gerente_conta_id');
    }

    public function gerenteGeral()
    {
        return $this->belongsTo(User::class, 'gerente_geral_id');
    }
}