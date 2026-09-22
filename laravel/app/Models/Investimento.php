<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investimento extends Model
{
    protected $fillable = ['conta_id', 'tipo_investimento_id', 'valor'];

    protected function casts(): array
    {
        return ['valor' => 'decimal:2'];
    }

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }

    public function tipoInvestimento()
    {
        return $this->belongsTo(TipoInvestimento::class);
    }

    public function movimentacoes()
    {
        return $this->hasMany(MovimentacaoInvestimento::class);
    }
}