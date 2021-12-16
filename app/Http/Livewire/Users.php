<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class Users extends Component
{
  use WithPagination;

  public $searchTerm = "";

  public function render()
  {
    // $users = User::search($this->searchTerm)->paginate(10);
    // $users = User::search($this->searchTerm, ['name', 'email', 'phone'])->paginate(10);

    // Buscar en modelos relacionados
    $users = User::search($this->searchTerm, ['name', 'email', 'phone', 'role.name', 'posts.title'])->paginate(10);
    
    return view('livewire.users', compact('users'));
  }
}