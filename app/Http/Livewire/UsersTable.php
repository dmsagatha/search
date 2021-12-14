<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersTable extends Component
{
  public $term = "";

  public function render()
  {
    // Retrasar la ejecución del código para simular la carga de una página
    sleep(1);

    $users = User::search($this->term)->paginate(10);

    $data = [
      'users' => $users,
    ];

    // return view('livewire.users-table', $data);
    return view('livewire.users-table', compact('users'));
  }
}