<?php

namespace Modules\Form\Database\Seeders;

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
            ["title" => "form-read", "description" => "Can read forms"],
            ["title" => "form-create", "description" => "Can create forms"],
            ["title" => "form-edit", "description" => "Can edit forms"],
            ["title" => "form-delete", "description" => "Can delete forms"],
            ["title" => "form-force-delete", "description" => "can delete form from database"],

            ["title" => "form-receive-read", "description" => "Can read receives of form"],
            ["title" => "form-receive-create", "description" => "Can create receives of form"],
            ["title" => "form-receive-edit", "description" => "Can edit receives of form"],
            ["title" => "form-receive-delete", "description" => "Can delete receives of form"],
            ["title" => "form-receive-force-delete", "description" => "can delete receive of form from database"],

            ["title" => "form-receive-export", "description" => "can export receives of a form"],
        ]);
    }
}
