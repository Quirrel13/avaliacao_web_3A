<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pix extends Model
{
    protected $table = 'pix';
    
    protected $fillable = ['conta_origem_id', 'conta_destino_id', 'valor', 'descricao'];

    protected function casts(): array
    {
        return ['valor' => 'decimal:2'];
    }

    public function contaOrigem()
    {
        return $this->belongsTo(Conta::class, 'conta_origem_id');
    }

    public function contaDestino()
    {
        return $this->belongsTo(Conta::class, 'conta_destino_id');
    }
}