<?php

namespace App\Repositories;

use App\Models\Disciplina;

class DisciplinaRepository extends BaseRepository {

    public function __construct(protected Disciplina $model) { }

    protected function getModel(): mixed {
        return $this->model->newInstance();
    }
}
