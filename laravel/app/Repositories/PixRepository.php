<?php

namespace App\Repositories;

use App\Models\Pix;
use Illuminate\Database\Eloquent\Collection;

class PixRepository
{
    public function createPix(array $data): Pix
    {
        return Pix::create($data);
    }

    public function getExtratoByContaId(int $contaId): Collection
    {
        return Pix::where('conta_origem_id', $contaId)
            ->orWhere('conta_destino_id', $contaId)
            ->latest()
            ->get();
    }
}