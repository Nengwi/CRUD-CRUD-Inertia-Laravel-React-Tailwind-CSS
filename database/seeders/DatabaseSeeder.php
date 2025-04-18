<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    // Buat role dan permission
    $role = Role::firstOrCreate(['name' => 'admin']);
    $permission = Permission::firstOrCreate(['name' => 'borrow books']);

    // Assign permission ke role
    $role->givePermissionTo($permission);

    // Assign role ke user dengan ID 1 (Pastikan user ID 1 ada di database)
    $user = User::find(1);
    if ($user) 
        $user->assignRole($role);
    }
}