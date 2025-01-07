<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Daftar semua permissions
         $permissions = [ 
            'manage categories',
            'manage packages',
            'manage transactions',
            'checkout package',
            'view orders',
        ];

    // Buat permissions jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        //menambahkan role customer
        $customerRole = Role::firstOrCreate([
            'name' => 'customer'
        ]);

        //memberikan permision pada role customer
        $customerPermissions = [
            'checkout package',
            'view orders'
        ];

        $customerRole->syncPermissions($customerPermissions);

        //menambah role super_admin
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        //membuat pengguna baru utk super_admin sesua tabel user
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'phone_number' => '6289439892',
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('123123123')
        ]);

        $user->assignRole($superAdminRole);


    }
}
