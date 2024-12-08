<?php

namespace Modules\Main\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Main\Models\Permission;
use Modules\Main\Models\Role;
use Nwidart\Modules\Facades\Module;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Role::query()->insertOrIgnore([
            [
                'title' => 'administrator',
                'description' => 'this role has all permissions and cannot be deleted',
                'hierarchy' => 0
            ], [
                'title' => 'admin',
                'description' => 'this role has all permissions',
                'hierarchy' => 1
            ], [
                'title' => 'user',
                'description' => 'this role can access to panel and its branches',
                'hierarchy' => 10
            ], [
                'title' => 'customers',
                'description' => 'this role registered but has no permission and are the customers',
                'hierarchy' => 10
            ], [
                'title' => 'abandonment',
                'description' => 'this role registered but has no permission',
                'hierarchy' => 100
            ]
        ]);

        $administratorRole = Role::firstWhere('title', 'administrator')->permissions()->attach(Permission::all());
        $adminRole = Role::firstWhere('title', 'admin')->permissions()->attach(Permission::all());
        $userRole = Role::firstWhere('title', 'user')->permissions()->attach(Permission::where('title', 'like', 'client-%')->get());
        //$userRole = Role::firstWhere('title', 'customers')->permissions()->attach(Permission::where('title', 'like', 'client-%')->get());



        cache()->forever('allPermissionsGates', Permission::query()->select(['title', 'id'])->get());

    }


}
