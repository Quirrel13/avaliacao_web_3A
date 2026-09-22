<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoInvestimento extends Model
{
    protected $table = 'tipos_investimento';

    protected $fillable = [
        'nome'
    ];

    public function investimentos()
    {
        return $this->hasMany(Investimento::class);
    }
}