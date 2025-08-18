<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);

        // create permissions
        $superAdminPermissions = [
            'view request kajian',
            'create request kajian',
            'edit request kajian',
            'delete request kajian',
            'approve request kajian',
            'reject request kajian',
            'view jadwal kajian',
            'create jadwal kajian',
            'edit jadwal kajian',
            'delete jadwal kajian',
            'view jenis kajian',
            'create jenis kajian',
            'edit jenis kajian',
            'delete jenis kajian',
            'view jabatan',
            'create jabatan',
            'edit jabatan',
            'delete jabatan',
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        $adminPermissions = [
            'view request kajian',
            'create request kajian',
            'edit request kajian',
            'delete request kajian',
            'approve request kajian',
            'reject request kajian',
            'view jadwal kajian',
            'create jadwal kajian',
            'edit jadwal kajian',
            'delete jadwal kajian',
            'view jenis kajian',
            'create jenis kajian',
            'edit jenis kajian',
            'delete jenis kajian',
            'view jabatan',
            'create jabatan',
            'edit jabatan',
            'delete jabatan',
        ];

        // assign permissions to roles
        foreach ($superAdminPermissions as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission]);
            $superAdmin->givePermissionTo($perm);
        }

        foreach ($adminPermissions as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission]);
            $admin->givePermissionTo($perm);
        }
    }
}
