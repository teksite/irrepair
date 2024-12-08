<?php

namespace Modules\Main\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Main\Models\Permission;
use Nwidart\Modules\Facades\Module;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->insertOrIgnore([
            /*---------------*/
            /*     Admin     */
            /*---------------*/
            [
                'title' => 'admin',
                'description' => 'access to admin panel',
            ],

            //User
            [
                'title' => 'user-read',
                'description' => 'can read users',
            ],
            [
                'title' => 'user-create',
                'description' => 'can creat user',
            ],
            [
                'title' => 'user-edit',
                'description' => 'can edit user',
            ],
            [
                'title' => 'user-delete',
                'description' => 'can delete user',
            ],

            [
                'title' => 'user-login',
                'description' => 'can login with user',
            ],


            // Roles
            [
                'title' => 'role-read',
                'description' => 'can read roles',
            ],
            [
                'title' => 'role-create',
                'description' => 'can creat role',
            ],
            [
                'title' => 'role-edit',
                'description' => 'can edit role',
            ],
            [
                'title' => 'role-delete',
                'description' => 'can delete role',
            ],

            //permissions
            [
                'title' => 'permission-read',
                'description' => 'can read permissions',
            ],
            [
                'title' => 'permission-create',
                'description' => 'can creat permission',
            ],
            [
                'title' => 'permission-edit',
                'description' => 'can edit permission',
            ],
            [
                'title' => 'permission-delete',
                'description' => 'can delete permission',
            ],

            //Settings
            [
                'title' => 'setting-edit',
                'description' => 'can read and edit overall site setting',
            ],

            //Tags
            [
                'title' => 'tag-edit',
                'description' => 'can moderate tags',
            ],


            // SEO
            [
                'title'=>'seo-edit',
                'description'=>'can edit seo of site and pages'
            ],

            /*---------------*/
            /*     Panel     */
            /*---------------*/
            [
                'title' => 'client-panel',
                'description' => 'access to user panel',
            ],

            [
                'title' => 'client-edit',
                'description' => 'Client can edit personal info ',
            ],
            [
                'title' => 'client-user-edit',
                'description' => 'Client can edit personal info ',
            ],
            [
                'title' => 'client-verify-phone',
                'description' => 'Client can verify phone',
            ],
            [
                'title' => 'client-password-edit',
                'description' => 'Client can change password',
            ],
            [
                'title' => 'client-two-factor-auth',
                'description' => 'Client enable/disable two factor authentication',
            ],
            [
                'title' => 'client-create-user',
                'description' => 'Client can change password',
            ],

        ]);

        $this->call([
            \Modules\Announcement\Database\Seeders\PermissionsSeeder::class,
            \Modules\Blog\Database\Seeders\PermissionsSeeder::class,
            \Modules\Widget\Database\Seeders\PermissionsSeeder::class,
            \Modules\Page\Database\Seeders\PermissionsSeeder::class,
            \Modules\Form\Database\Seeders\PermissionsSeeder::class,
            \Modules\Menu\Database\Seeders\PermissionsSeeder::class,
            \Modules\Comment\Database\Seeders\PermissionsSeeder::class,
           \Modules\Shop\Database\Seeders\PermissionsSeeder::class,

            \Modules\Theme\Database\Seeders\PermissionsSeeder::class,
        ]);

        cache()->forever('allPermissionsGates', Permission::query()->select(['title','id'])->get());
        cache()->forever('allPermissions', Permission::query()->select(['title','id'])->get());
    }
}
