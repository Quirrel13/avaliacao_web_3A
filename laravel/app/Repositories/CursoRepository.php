<?php

namespace App\Repositories;

use App\Models\Curso;

class CursoRepository extends BaseRepository {

    public function __construct(protected Curso $model) {}

    protected function getModel(): mixed {
        return $this->model->newInstance();
    }
}
