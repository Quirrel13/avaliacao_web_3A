<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'carga_horaria',
        'curso_id',
    ];

    public function curso() {
        return $this->belongsTo('\App\Models\Curso');
    }

    public function aluno() {
        return $this->belongsToMany('\App\Models\Aluno', 'matriculas');
    }
}
