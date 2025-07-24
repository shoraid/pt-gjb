<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function getList()
    {
        return Role::query()
            ->latest('id')
            ->paginate();
    }

    public function getPermissionList()
    {
        return Permission::query()
            ->with(['children:id,parent_id,name'])
            ->where('parent_id', null)
            ->get(['parent_id', 'id', 'name']);
    }

    public function getPermissionIds(Role $role): array
    {
        return $role->permissions->pluck('id')->all();
    }

    public function create(array $data, int $userId): Role
    {
        return DB::transaction(function () use ($data, $userId) {
            $role = Role::query()->create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'created_by_id' => $userId,
            ]);

            $role->permissions()->attach($data['permission_ids'] ?? []);

            return $role;
        });
    }

    public function update(Role $role, array $data)
    {
        return DB::transaction(function () use ($role, $data) {
            $role->update([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
            ]);

            $role->permissions()->sync($data['permission_ids'] ?? []);
        });
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }
}
