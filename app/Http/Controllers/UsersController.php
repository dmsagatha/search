<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\UserTable;
use Illuminate\Http\Request;

class UsersController extends Controller
{
  public function index()
  {
    $usersPaginate = User::with(['role', 'posts'])
      ->sortable()
      ->paginate();

    $users = new UserTable($usersPaginate);

    return view('users.table', compact('users'));
  }
}