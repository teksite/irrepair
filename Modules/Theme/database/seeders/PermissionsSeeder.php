<?php

namespace Modules\Theme\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Main\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->insert([

            ["title" => "theme-edit", "description" => "Can edit theme"],

        ]);
    }
}
