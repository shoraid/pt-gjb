<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Role $role */
        $adminRole = Role::factory()->create([
            'name' => 'Admin',
            'can_delete' => false,
        ]);

        $permissionIds = Permission::query()
            ->where('parent_id', '!=', null)
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        $adminRole->permissions()->attach($permissionIds);

        // DANGER: It must have ID 2 since the enum value for COMMON_USER is 2
        $commonUserRole = Role::factory()->create([
            'name' => 'Common User',
            'can_delete' => false,
        ]);

        $notePermissionIds = Permission::query()
            ->where('parent_id', PermissionEnum::NOTES)
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        $commonUserRole->permissions()->attach($notePermissionIds);

        Role::factory(100)->create();
    }
}
