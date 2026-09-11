<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService extends BaseService {

    public function __construct(protected PermissionRepository $repository) {}

    protected function getRepository(): mixed {
        return $this->repository;
    }

    public function getPermissions($role) {
        $arr = Array();
        $perm = $this->repository->list(['resource'], ['field' => 'role_id', 'value' => $role], 'resource_id');

        foreach($perm as $item) {
            $arr[$item->resource->name] = true;
        }

        return $arr;
    }

    public function loadPermissions($role) {

        $arr_permissions = $this->getPermissions($role);
        
        // dd($arr_permissions);
        session(['user_permissions' => $arr_permissions]);
    }

    public function isAuthorized($resource, $user) {
        
        $permissions = session('user_permissions');

        if(!isset($permissions)) $permissions = $this->getPermissions($user->role_id);

        if(array_key_exists($resource, $permissions)) {
            return true;
        }
        return false;
    }
}
