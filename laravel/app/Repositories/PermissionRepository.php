<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends BaseRepository {

    public function __construct(protected Permission $model) {}

    protected function getModel(): mixed {
        return $this->model->newInstance();
    }
}
