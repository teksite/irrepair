<?php

namespace Modules\Shop\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Main\Models\Permission;

class PermissionsSeeder extends Seeder
{

    public function run(): void
    {
        Permission::query()->insert([
            ["title" => "product-category-read", "description" => "Can read categories of products"],
            ["title" => "product-category-create", "description" => "Can create categories of products"],
            ["title" => "product-category-edit", "description" => "Can edit categories of products"],
            ["title" => "product-category-delete", "description" => "Can delete categories of products"],
            ["title" => "product-category-force-delete", "description" => "can delete categories of products from database"],

            ["title" => "product-read", "description" => "Can read products"],
            ["title" => "product-create", "description" => "Can create products"],
            ["title" => "product-edit", "description" => "Can edit products"],
            ["title" => "product-delete", "description" => "Can delete products"],
            ["title" => "product-force-delete", "description" => "can delete product from database"],

            ["title" => "order-read", "description" => "Can read orders"],
            ["title" => "order-create", "description" => "Can create orders"],
            ["title" => "order-edit", "description" => "Can edit orders"],
            ["title" => "order-change", "description" => "Can change orders"],
            ["title" => "order-delete", "description" => "Can delete orders"],
            ["title" => "order-force-delete", "description" => "can delete order from database"],
        ]);
    }
}
