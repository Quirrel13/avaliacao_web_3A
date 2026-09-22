<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    abstract public function getModel(): Model;

    public function all()
    {
        return $this->getModel()->all();
    }

    public function find(int|string $id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

    public function update(int|string $id, array $data)
    {
        $row = $this->find($id);
        $row->update($data);
        return $row;
    }

    public function delete(int|string $id)
    {
        $row = $this->find($id);
        return $row->delete();
    }

    public function audit(int|string $id)
    {
        $row = $this->getModel()->findOrFail($id);

        return $row->audits()->with('user')->latest()->get()->transform(
            function ($audit) {
                $old = is_string($audit->old_values) ? json_decode($audit->old_values, true) : (array) $audit->old_values;
                $new = is_string($audit->new_values) ? json_decode($audit->new_values, true) : (array) $audit->new_values;

                $audit->old_values = array_map('strval', $old ?? []);
                $audit->new_values = array_map('strval', $new ?? []);

                return $audit;
            }
        );
    }
}