<?php

namespace Modules\Comment\Database\Seeders;

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
            ["title" => "comment-read", "description" => "Can read comments"],
            ["title" => "comment-create", "description" => "Can create comments"],
            ["title" => "comment-edit", "description" => "Can edit comments"],
            ["title" => "comment-delete", "description" => "Can delete comments"],
            ["title" => "comment-force-delete", "description" => "can delete widget from database"],

            ["title" => "client-comment-read", "description" => "Client can read comments"],
            ["title" => "client-comment-create", "description" => "Client can create comments"],
            ["title" => "client-comment-edit", "description" => "Client can edit comments"],
            ["title" => "client-comment-delete", "description" => "Client can delete posts"],

        ]);
    }
}
