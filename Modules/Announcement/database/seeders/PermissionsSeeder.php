<?php

namespace Modules\Announcement\Database\Seeders;

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
            ["title" => "announcement-read", "description" => "Can read announcements"],
            ["title" => "announcement-create", "description" => "Can create announcements"],
            ["title" => "announcement-edit", "description" => "Can edit announcements"],
            ["title" => "announcement-delete", "description" => "Can delete announcements"],
            ["title" => "announcement-force-delete", "description" => "can delete announcement from database"],
            ["title" => "client-announcement-read", "description" => "client can read announcements"],
        ]);
    }
}
