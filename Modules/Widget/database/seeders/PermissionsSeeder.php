<?php

namespace Modules\Widget\Database\Seeders;

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
            ["title" => "widget-read", "description" => "Can read widgets"],
            ["title" => "widget-create", "description" => "Can create widgets"],
            ["title" => "widget-edit", "description" => "Can edit widgets"],
            ["title" => "widget-delete", "description" => "Can delete widgets"],
            ["title" => "widget-force-delete", "description" => "can delete widget from database"],
        ]);
    }
}
