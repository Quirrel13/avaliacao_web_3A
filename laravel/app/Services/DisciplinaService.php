<?php

namespace App\Services;

use App\Repositories\DisciplinaRepository;

class DisciplinaService extends BaseService {

    public function __construct(protected DisciplinaRepository $repository) { }

    protected function getRepository(): mixed {
        return $this->repository;
    }
}
