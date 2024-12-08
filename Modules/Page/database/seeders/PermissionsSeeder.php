<?php

namespace Modules\Page\Database\Seeders;

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
            ["title" => "page-read", "description" => "Can read pages"],
            ["title" => "page-create", "description" => "Can create pages"],
            ["title" => "page-edit", "description" => "Can edit pages"],
            ["title" => "page-delete", "description" => "Can delete pages"],
            ["title" => "page-force-delete", "description" => "can delete page from database"],
        ]);
    }
}
