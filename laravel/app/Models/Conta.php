<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Conta extends Model implements Auditable
{
    use SoftDeletes, AuditableTrait;

    protected $fillable = ['usuario_id', 'gerente_id', 'saldo', 'limite', 'bloqueada'];

    protected function casts(): array
    {
        return [
            'saldo' => 'decimal:2',
            'limite' => 'decimal:2',
            'bloqueada' => 'boolean',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function gerente()
    {
        return $this->belongsTo(User::class, 'gerente_id');
    }

    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class);
    }

    public function investimentos()
    {
        return $this->hasMany(Investimento::class);
    }

    public function pixEnviados()
    {
        return $this->hasMany(Pix::class, 'conta_origem_id');
    }

    public function pixRecebidos()
    {
        return $this->hasMany(Pix::class, 'conta_destino_id');
    }
}