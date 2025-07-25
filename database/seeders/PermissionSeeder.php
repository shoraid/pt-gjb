<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Permissions
            [
                'parent_id' => null,
                'id' => PermissionEnum::PERMISSIONS,
                'name' => __('permission.permissions.group'),
                'display_order' => 1,
            ],
            [
                'parent_id' => PermissionEnum::PERMISSIONS,
                'id' => PermissionEnum::PERMISSIONS__LIST,
                'name' => __('permission.permissions.list'),
                'display_order' => 1,
            ],
            [
                'parent_id' => PermissionEnum::PERMISSIONS,
                'id' => PermissionEnum::PERMISSIONS__DETAIL,
                'name' => __('permission.permissions.detail'),
                'display_order' => 2,
            ],
            [
                'parent_id' => PermissionEnum::PERMISSIONS,
                'id' => PermissionEnum::PERMISSIONS__CREATE,
                'name' => __('permission.permissions.create'),
                'display_order' => 3,
            ],
            [
                'parent_id' => PermissionEnum::PERMISSIONS,
                'id' => PermissionEnum::PERMISSIONS__UPDATE,
                'name' => __('permission.permissions.update'),
                'display_order' => 4,
            ],
            [
                'parent_id' => PermissionEnum::PERMISSIONS,
                'id' => PermissionEnum::PERMISSIONS__DELETE,
                'name' => __('permission.permissions.delete'),
                'display_order' => 5,
            ],

            // Roles
            [
                'parent_id' => null,
                'id' => PermissionEnum::ROLES,
                'name' => __('permission.roles.group'),
                'display_order' => 2,
            ],
            [
                'parent_id' => PermissionEnum::ROLES,
                'id' => PermissionEnum::ROLES__LIST,
                'name' => __('permission.roles.list'),
                'display_order' => 1,
            ],
            [
                'parent_id' => PermissionEnum::ROLES,
                'id' => PermissionEnum::ROLES__DETAIL,
                'name' => __('permission.roles.detail'),
                'display_order' => 2,
            ],
            [
                'parent_id' => PermissionEnum::ROLES,
                'id' => PermissionEnum::ROLES__CREATE,
                'name' => __('permission.roles.create'),
                'display_order' => 3,
            ],
            [
                'parent_id' => PermissionEnum::ROLES,
                'id' => PermissionEnum::ROLES__UPDATE,
                'name' => __('permission.roles.update'),
                'display_order' => 4,
            ],
            [
                'parent_id' => PermissionEnum::ROLES,
                'id' => PermissionEnum::ROLES__DELETE,
                'name' => __('permission.roles.delete'),
                'display_order' => 5,
            ],

            // Users
            [
                'parent_id' => null,
                'id' => PermissionEnum::USERS,
                'name' => __('permission.users.group'),
                'display_order' => 3,
            ],
            [
                'parent_id' => PermissionEnum::USERS,
                'id' => PermissionEnum::USERS__LIST,
                'name' => __('permission.users.list'),
                'display_order' => 1,
            ],
            [
                'parent_id' => PermissionEnum::USERS,
                'id' => PermissionEnum::USERS__DETAIL,
                'name' => __('permission.users.detail'),
                'display_order' => 2,
            ],
            [
                'parent_id' => PermissionEnum::USERS,
                'id' => PermissionEnum::USERS__CREATE,
                'name' => __('permission.users.create'),
                'display_order' => 3,
            ],
            [
                'parent_id' => PermissionEnum::USERS,
                'id' => PermissionEnum::USERS__UPDATE,
                'name' => __('permission.users.update'),
                'display_order' => 4,
            ],
            [
                'parent_id' => PermissionEnum::USERS,
                'id' => PermissionEnum::USERS__DELETE,
                'name' => __('permission.users.delete'),
                'display_order' => 5,
            ],

            // Notes
            [
                'parent_id' => null,
                'id' => PermissionEnum::NOTES,
                'name' => __('permission.notes.group'),
                'display_order' => 4,
            ],
            [
                'parent_id' => PermissionEnum::NOTES,
                'id' => PermissionEnum::NOTES__LIST,
                'name' => __('permission.notes.list'),
                'display_order' => 1,
            ],
            [
                'parent_id' => PermissionEnum::NOTES,
                'id' => PermissionEnum::NOTES__DETAIL,
                'name' => __('permission.notes.detail'),
                'display_order' => 2,
            ],
            [
                'parent_id' => PermissionEnum::NOTES,
                'id' => PermissionEnum::NOTES__CREATE,
                'name' => __('permission.notes.create'),
                'display_order' => 3,
            ],
            [
                'parent_id' => PermissionEnum::NOTES,
                'id' => PermissionEnum::NOTES__UPDATE,
                'name' => __('permission.notes.update'),
                'display_order' => 4,
            ],
            [
                'parent_id' => PermissionEnum::NOTES,
                'id' => PermissionEnum::NOTES__DELETE,
                'name' => __('permission.notes.delete'),
                'display_order' => 5,
            ],
        ];

        $now = now()->subDay();
        $permissions = collect($permissions)
            ->map(function ($permission, int $i) use ($now) {
                $permission['created_at'] = $now->copy()->addHours($i);
                return $permission;
            })
            ->toArray();

        DB::table('permissions')->insert($permissions);
    }
}
