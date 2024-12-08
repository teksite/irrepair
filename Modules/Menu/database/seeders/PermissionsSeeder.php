<?php

namespace Modules\Menu\Database\Seeders;

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
            ["title" => "menu-read", "description" => "Can read menus"],
            ["title" => "menu-create", "description" => "Can create menus"],
            ["title" => "menu-edit", "description" => "Can edit menus"],
            ["title" => "menu-delete", "description" => "Can delete menus"],
            ["title" => "menu-delete-force", "description" => "can delete menu from database"],
        ]);
    }
}
