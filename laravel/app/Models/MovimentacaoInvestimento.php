<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentacaoInvestimento extends Model
{
    protected $table = 'movimentacoes_investimento';
    
    protected $fillable = ['investimento_id', 'tipo', 'valor'];

    protected function casts(): array
    {
        return ['valor' => 'decimal:2'];
    }

    public function investimento()
    {
        return $this->belongsTo(Investimento::class);
    }
}