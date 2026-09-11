<?php

namespace App\Policies;

use App\Models\Curso;
use App\Models\User;
use App\Services\PermissionService;

class CursoPolicy {

    public function __construct(protected PermissionService $service) {}

    public function viewAny(User $user): bool {
        return $this->service->isAuthorized('curso.index', $user);
    }

    public function view(User $user, Curso $curso): bool {
        return $this->service->isAuthorized('curso.show', $user);
    }

    public function create(User $user): bool {
         return $this->service->isAuthorized('curso.create', $user);
    }

    public function update(User $user, Curso $curso): bool {
        return $this->service->isAuthorized('curso.edit', $user);

    }

    public function delete(User $user, Curso $curso): bool {
        return $this->service->isAuthorized('curso.delete', $user);

    }
    public function restore(User $user, Curso $curso): bool {
        return $this->service->isAuthorized('curso.delete', $user);
    }

    public function forceDelete(User $user, Curso $curso): bool
    {
        return $this->service->isAuthorized('curso.delete', $user);
    }
}
