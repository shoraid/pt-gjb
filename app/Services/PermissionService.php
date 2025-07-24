<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService
{
    public function getList()
    {
        return Permission::with(['parent'])
            ->latest('created_at')
            ->paginate();
    }

    public function getParentList()
    {
        return Permission::query()
            ->where('parent_id', null)
            ->get(['id', 'name']);
    }

    public function create(array $data)
    {
        return Permission::query()->create([
            'id' => $data['id'],
            'name' => $data['name'],
            'display_order' => $data['display_order'],
            'parent_id' => $data['parent_id'] ?? null,
            'description' => $data['description'] ?? null,
        ]);
    }

    public function update(Permission $permission, array $data)
    {
        return $permission->update([
            'name' => $data['name'],
            'display_order' => $data['display_order'],
            'parent_id' => $data['parent_id'] ?? null,
            'description' => $data['description'] ?? null
        ]);
    }

    public function delete(Permission $permission)
    {
        return $permission->delete();
    }
}
