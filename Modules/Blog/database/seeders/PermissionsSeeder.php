<?php

namespace Modules\Blog\Database\Seeders;

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
            ["title" => "post-read", "description" => "Can read posts"],
            ["title" => "post-create", "description" => "Can create posts"],
            ["title" => "post-edit", "description" => "Can edit posts"],
            ["title" => "post-delete", "description" => "Can delete posts"],
            ["title" => "post-force-delete", "description" => "can delete post from database"],

            ["title"=>"post-category-read",'description'=>"Can read posts"],
            ["title"=>"post-category-create",'description'=>"Can create a post"],
            ["title"=>"post-category-edit",'description'=>"Can change posts"],
            ["title"=>"post-category-delete",'description'=>"Can delete posts"],

            ["title" => "article-read", "description" => "Can read articles"],
            ["title" => "article-create", "description" => "Can create articles"],
            ["title" => "article-edit", "description" => "Can edit articles"],
            ["title" => "article-delete", "description" => "Can delete articles"],
            ["title" => "article-force-delete", "description" => "can delete article from database"],

            ["title" => "client-post-read", "description" => "Client can read posts"],
            ["title" => "client-post-create", "description" => "Client can create posts"],
            ["title" => "client-post-edit", "description" => "Client can edit posts"],
            ["title" => "client-post-delete", "description" => "Client can delete posts"],

        ]);
    }
}
