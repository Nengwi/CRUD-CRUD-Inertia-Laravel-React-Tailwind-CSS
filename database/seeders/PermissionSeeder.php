<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; //Mengimpor model Role dari paket Spatie/Permission. Model ini digunakan untuk merepresentasikan peran (roles) pengguna.
use Spatie\Permission\Models\Permission; //Mengimpor model Permission dari paket Spatie/Permission. Model ini digunakan untuk merepresentasikan izin (permissions) yang diberikan kepada pengguna atau peran.

class PermissionSeeder extends Seeder //Mendefinisikan kelas PermissionSeeder yang mengextends kelas Seeder. Ini artinya, seeder ini akan mengikuti struktur dan perilaku kelas Seeder milik Laravel.
{
    /**
     * Run the database seeds.
     */
    public function run() //Mendefinisikan metode run, yang merupakan metode yang akan dijalankan ketika seeder dijalankan.
    {
        $createPost = Permission::create(['name' => 'create_post']); //Membuat izin baru dengan nama 'create_post' dan menyimpannya dalam variabel $createPost.
        $editPost = Permission::create(['name' => 'edit_post']); //Membuat izin baru dengan nama 'edit_post' dan menyimpannya dalam variabel $editPost.
        $deletePost = Permission::create(['name' => 'delete_post']); //Membuat izin baru dengan nama 'delete_post' dan menyimpannya dalam variabel $deletePost.

        $role = Role::create(['name' => 'editor']); // Membuat peran baru dengan nama 'editor' dan menyimpannya dalam variabel $role.
        $role->givePermissionTo($createPost, $editPost, $deletePost); //Memberikan izin-izin yang sudah dibuat sebelumnya ($createPost, $editPost, $deletePost) kepada peran yang baru dibuat ($role).
    }
}

//Jadi, seeder ini bertujuan untuk membuat tiga izin ('create_post', 'edit_post', 'delete_post') didalam satu peran yakni ('editor') yang memiliki ketiga izin tersebut.