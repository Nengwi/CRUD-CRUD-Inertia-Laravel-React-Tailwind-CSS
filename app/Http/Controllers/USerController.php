<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class UserController extends Controller
{
    public function index() //Mendefinisikan metode index, yang umumnya digunakan untuk menangani permintaan terkait halaman indeks atau daftar.
    {
        $users = User::with('roles')->get(); //Mengambil semua data pengguna dari model User beserta informasi peran (roles) yang terkait. Metode with('roles') digunakan untuk memuat relasi 'roles' sehingga data peran pengguna juga dapat diakses.
        return Inertia::render('Users/Index', ['users' => $users]); //Mengembalikan tampilan menggunakan Inertia.js dengan nama 'Users/Index' dan menyertakan data pengguna sebagai array asosiatif dengan kunci 'users'. 
    }                           //  Merupakan nama tampilan yang akan digunakan. Dengan menggunakan Inertia.js, ini akan diinterpretasikan sebagai komponen atau halaman React Js
    public function editUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return Inertia::render('404')->with('message', 'User not found')->status(404);
        }

        $editorRole = 'editor';

        if ($user->hasRole($editorRole)) {
            $user->removeRole($editorRole);
        } else {
            $user->assignRole($editorRole);
        }
        return redirect(route('user.index'))->with('success', 'Role Updated.');
    }
}
