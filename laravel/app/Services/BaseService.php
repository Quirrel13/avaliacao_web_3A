<?php

namespace App\Services;

use App\Repositories\BaseRepository;

abstract class BaseService
{
    abstract public function getRepository(): BaseRepository;

    public function all()
    {
        return $this->getRepository()->all();
    }

    public function find(int|string $id)
    {
        return $this->getRepository()->find($id);
    }

    public function create(array $data)
    {
        return $this->getRepository()->create($data);
    }

    public function update(int|string $id, array $data)
    {
        return $this->getRepository()->update($id, $data);
    }

    public function delete(int|string $id)
    {
        return $this->getRepository()->delete($id);
    }

    public function audit(int|string $id)
    {
        return $this->getRepository()->audit($id);
    }
}