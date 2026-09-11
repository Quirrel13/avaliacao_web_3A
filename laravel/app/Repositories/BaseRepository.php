<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository {

    abstract protected function getModel(): mixed;

    public function list(array $arrWith = [], array $where = [], string $orderBy = 'id') {
        if(isset($where['field']) && isset($where['value'])) {
            return $this->getModel()->with($arrWith)->where($where['field'], $where['value'])
                ->orderBy($orderBy)->get();
        }
        return $this->getModel()->with($arrWith)->orderBy($orderBy)->get();
    }

    public function listPaginate(array $arrWith = [], array $where = [], string $orderBy = 'id', int $limit = 6) {
        if(isset($where['field']) && isset($where['value'])) {
            return $this->getModel()->with($arrWith)->where($where['field'], $where['value'])
                ->orderBy($orderBy)->paginate($limit);
        }
        return $this->getModel()->with($arrWith)->orderBy($orderBy)->paginate($limit);
    }

    public function find(int|string $id, array $arrWith = []): ?Model {
        return $this->getModel()->with($arrWith)->find($id);
    }

    public function store(array $data): ?Model {
        return $this->getModel()->create($data);
    }

    public function update(array $data, int|string $id): ?Model {
        $row = $this->getModel()->findOrFail($id);
        $row->update($data);
        return $row;
    }

    public function remove(int|string $id): ?bool {
        $row = $this->getModel()->findOrFail($id);
        return $row->delete();
    }

    public function audit(int|string $id) {
        $row = $this->getModel()->findOrFail($id);

        return $row->audits()->with('user')->latest()->get()->transform(function ($audit) {
            $old = is_string($audit->old_values) ? json_decode($audit->old_values, true) : (array)$audit->old_values;
            $new = is_string($audit->new_values) ? json_decode($audit->new_values, true) : (array)$audit->new_values;
            // Força todos os valores internos do array a virarem strings
            $audit->old_values = array_map('strval', $old ?? []);
            $audit->new_values = array_map('strval', $new ?? []);

            return $audit;
        });
    }
}
