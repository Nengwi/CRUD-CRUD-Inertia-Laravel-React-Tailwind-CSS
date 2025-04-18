<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class BorrowingController extends Controller
{
    public function store(Book $book)
    {
        $user = Auth::user();

        dd([
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions(),
            'has_permission' => $user->hasPermissionTo('borrow books', 'web'),
        ]);
    }
} 
