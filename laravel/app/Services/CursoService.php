<?php

namespace App\Services;

use App\Repositories\CursoRepository;

class CursoService extends BaseService {

    public function __construct(protected CursoRepository $repository) {}

    protected function getRepository(): mixed {
        return $this->repository;
    }
}
