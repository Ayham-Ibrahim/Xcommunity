<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         // Misc
        $miscPermission = Permission::create(['name' => 'N/A']);

        // USER MODEL
        $userPermission1 = Permission::create(['name' => 'create: user']);
        $userPermission2 = Permission::create(['name' => 'read: user']);
        $userPermission3 = Permission::create(['name' => 'update: user']);
        $userPermission4 = Permission::create(['name' => 'delete: user']);

        // ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'create: role']);
        $rolePermission2 = Permission::create(['name' => 'read: role']);
        $rolePermission3 = Permission::create(['name' => 'update: role']);
        $rolePermission4 = Permission::create(['name' => 'delete: role']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'create: permission']);
        $permission2 = Permission::create(['name' => 'read: permission']);
        $permission3 = Permission::create(['name' => 'update: permission']);
        $permission4 = Permission::create(['name' => 'delete: permission']);

        // article MODEL
        $createArticle = Permission::create(['name' => 'create: article']);
        $readArticle = Permission::create(['name' => 'read: article']);
        $updateArticle = Permission::create(['name' => 'update: article']);
        $deleteArticle = Permission::create(['name' => 'delete: article']);

        //  Store MODEL
        $createBook = Permission::create(['name' => 'create: Book']);
        $readBook = Permission::create(['name' => 'read: Book']);
        $updateBook = Permission::create(['name' => 'update: Book']);
        $deleteBook = Permission::create(['name' => 'delete: Book']);
        $createSupplement = Permission::create(['name' => 'create: Supplement']);
        $readSupplement = Permission::create(['name' => 'read: Supplement']);
        $updateSupplement = Permission::create(['name' => 'update: Supplement']);
        $deleteSupplement = Permission::create(['name' => 'delete: Supplement']);

        // ADMINS
        $adminPermission1 = Permission::create(['name' => 'read: admin']);
        $adminPermission2 = Permission::create(['name' => 'update: admin']);

        // CREATE ROLES
        $userRole = Role::create(['name' => 'user'])->syncPermissions([
            $miscPermission,
        ]);

        $owner = Role::create(['name' => 'owner'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $userPermission1,
        ]);

        $bloger = Role::create(['name' => 'bloger'])->syncPermissions([
            $createArticle,
            $readArticle,
            $updateArticle,
            $deleteArticle,
        ]);
        $marketer = Role::create(['name' => 'marketer'])->syncPermissions([
            $createBook,
            $readBook,
            $updateBook,
            $deleteBook,
            $createSupplement,
            $readSupplement,
            $updateSupplement,
            $deleteSupplement,
        ]);

        User::create([
            'name' => 'owner',
            'is_admin' => 1,
            'role_name' =>'owner',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('owner1234'),
            'remember_token' => Str::random(10),
        ])->assignRole($owner);

        User::create([
            'name' => 'marketer',
            'is_admin' => 1,
            'role_name' =>'marketer',
            'email' => 'marketer@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('marketer1234'),
            'remember_token' => Str::random(10),
        ])->assignRole($marketer);


        User::create([
            'name' => 'bloger',
            'is_admin' => 1,
            'role_name' =>'bloger',
            'email' => 'bloger@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('bloger1234'),
            'remember_token' => Str::random(10),
        ])->assignRole($bloger);;

    }
}
