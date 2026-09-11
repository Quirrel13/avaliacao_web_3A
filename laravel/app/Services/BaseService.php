<?php

namespace App\Services;

abstract class BaseService {

    abstract protected function getRepository(): mixed;

    public function all(array $arrWith = [], array $where = [], string $orderBy = 'id') {
        return $this->getRepository()->list($arrWith, $where, $orderBy);
    }

    public function allPaginate(array $arrWith = [], array $where = [], string $orderBy = 'id', int $limit = 6) {
        return $this->getRepository()->listPaginate($arrWith, $where, $orderBy, $limit);
    }

    public function find(int|string $id, array $with = []) {
        return $this->getRepository()->find($id, $with);
    }

    public function store(array $data) {
        return $this->getRepository()->store($data);
    }

    public function update(array $data, int|string $id) {
        return $this->getRepository()->update($data, $id);
    }

    public function remove(int|string $id) {
        return $this->getRepository()->remove($id);
    }

    public function audit(int|string $id) {
        return $this->getRepository()->audit($id);
    }
}
